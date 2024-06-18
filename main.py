
from fastapi import FastAPI, HTTPException
from fastapi.middleware.cors import CORSMiddleware
from pymongo import MongoClient
from pydantic import BaseModel
import random
import threading
import time
from bson import ObjectId
from fastapi.encoders import jsonable_encoder
from typing import List

app = FastAPI()

# Conectar ao MongoDB
client = MongoClient(host="localhost", port=27017)
db = client["irrigation"]
collection = db["humidity"]

class HumidityData(BaseModel):
    humidity: int
    remaining: int
    plant_id: str

def generate_and_store_data():
    """Função para gerar e armazenar dados de umidade aleatórios para diferentes plantas."""
    plant_ids = ['plant1', 'plant2', 'plant3', 'plant4']  # Lista de IDs de plantas
    while True:
        for plant_id in plant_ids:
            humidity = random.randint(0, 100)
            remaining = 100 - humidity
            data = {"humidity": humidity, "remaining": remaining, "plant_id": plant_id, "timestamp": time.time()}
            collection.insert_one(data)
        time.sleep(5)

@app.get("/humidity/{plant_id}", response_model=List[HumidityData])
async def get_humidity_data(plant_id: str):
    """Endpoint para obter o dado de umidade mais recente de uma planta específica."""
    data = collection.find({"plant_id": plant_id}).sort("_id", -1).limit(1)
    result = []
    for item in data:
        item["_id"] = str(item["_id"])
        result.append(item)
    if not result:
        raise HTTPException(status_code=404, detail="Plant ID not found")
    return jsonable_encoder(result)

@app.get("/all-humidity", response_model=List[HumidityData])
async def get_all_humidity_data():
    """Endpoint para obter todos os dados de umidade armazenados."""
    data = collection.find()
    result = []
    for item in data:
        item["_id"] = str(item["_id"])
        result.append(item)
    return jsonable_encoder(result)

# Adicionar middleware de CORS
app.add_middleware(
    CORSMiddleware,
    allow_origins=["http://localhost"],  # Pode adicionar mais origens, se necessário
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

# Iniciar a geração e armazenamento de dados em um thread separado
threading.Thread(target=generate_and_store_data, daemon=True).start()
