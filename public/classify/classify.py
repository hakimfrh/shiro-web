from fastapi import FastAPI
from tensorflow.keras.models import load_model
from tensorflow.keras.utils import load_img, img_to_array
from tensorflow.nn import softmax
from tensorflow import expand_dims
from fastapi.responses import JSONResponse
import numpy as np
import os
from pydantic import BaseModel
from rembg import remove
from PIL import Image
import cv2

class ImagePath(BaseModel):
    path: str

# Inisialisasi aplikasi FastAPI
app = FastAPI()

# Load model sekali di awal
model_path = os.path.join(os.getcwd(), "public", "classify", "model-koi V6.0.26 32_64_128-128.keras")
model = load_model(model_path)
# class_names = ['KOHAKU', 'OTSHURI MONO - SHIRO OTSHURI', 'SHOWA SANSHOKU']
class_names = ['HI UTSHURI', 'KI UTSHURI', 'KOHAKU', 'OTSHURI MONO - SHIRO OTSHURI', 'SHOWA SANSHOKU', 'TANCHO KOHAKU']

def preprocess(image_input: Image.Image) -> Image.Image:
    # Buka gambar
    # image_input = Image.open(image_path)
    # image = cv2.imread(image_path, cv2.IMREAD_UNCHANGED)
    image_output = remove(image_input)
    image_mask = np.asarray(image_output)[:,:,3] 
    # Konversi mask ke format biner (0 dan 255)
    binary_mask = (image_mask > 127).astype(np.uint8) * 255
    # Kernel untuk operasi morfologi
    kernel = np.ones((5, 5), np.uint8)
    # Menghapus noise kecil (Opening)
    cleaned_mask = cv2.morphologyEx(binary_mask, cv2.MORPH_OPEN, kernel)
    # Menutup celah dalam objek (Closing)
    cleaned_mask = cv2.morphologyEx(cleaned_mask, cv2.MORPH_CLOSE, kernel)
    
    
    # Temukan kontur dari mask
    contours, _ = cv2.findContours(cleaned_mask, cv2.RETR_EXTERNAL, cv2.CHAIN_APPROX_SIMPLE)
    # Buat mask baru dengan objek terbesar
    image_contours = cv2.cvtColor(cleaned_mask,cv2.COLOR_GRAY2RGB)
    cv2.drawContours(image_contours, contours, -1, (0, 255, 0), 5)
    
    final_mask = np.zeros_like(cleaned_mask)
    
    # Buat mask kosong
    largest_mask = np.zeros_like(binary_mask)
    # Cari contour dengan area terbesar
    if(len(contours)>0):
        largest_contour = max(contours, key=cv2.contourArea)
        # Gambar contour dengan area terbesar pada mask baru
        cv2.drawContours(largest_mask, [largest_contour], -1, 255, thickness=cv2.FILLED)
    
    # Terapkan mask pada gambar asli
    image_input_array = np.asarray(image_input.convert("RGBA"))  # Konversi ke RGBA untuk memastikan ada alpha
    bgr_image = image_input_array[:, :, :3]  # Ambil channel RGB
    alpha_channel = largest_mask  # Gunakan largest_mask sebagai alpha mask
    
    # Buat background biru
    blue_background = np.full_like(bgr_image, (30,171,223))  # Warna biru dalam RGB
    
    # Terapkan mask ke gambar
    alpha_factor = alpha_channel[:, :, np.newaxis] / 255.0
    blended_image = (bgr_image * alpha_factor + blue_background * (1 - alpha_factor)).astype(np.uint8)
    
     # Konversi kembali ke format PIL
    return Image.fromarray(blended_image, "RGB")

@app.post("/detect-koi")
async def classify_image(image: ImagePath):
    path = image.path
    try:
        img_path = os.path.join(os.getcwd(), "storage", "app", "public", path)

        if not os.path.exists(img_path):
            raise FileNotFoundError(f"Path {img_path} tidak ditemukan.")

        img_height, img_width = 256, 256
        img = load_img(img_path, target_size=(img_height, img_width))
        img = preprocess(img)
        img_array = img_to_array(img)
        img_array = np.expand_dims(img_array, 0)  # Menambahkan dimensi batch

        # Melakukan prediksi
        predictions = model.predict(img_array)

        # Mendapatkan kelas dengan probabilitas tertinggi
        predicted_class = class_names[np.argmax(predictions)]
        predicted_prob = np.max(predictions)

        result = {
            "predictions": [
                {"class": class_name, "confidence": float(predictions[0,i])}
                for i, class_name in enumerate(class_names)
            ],
            "most_likely": {
                "class": predicted_class,
                "confidence": float(predicted_prob),
            }
        }

        return JSONResponse(content=result)

    except Exception as e:
        return JSONResponse(content={"error": str(e)}, status_code=500)