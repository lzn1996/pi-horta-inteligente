# from fastapi import FastAPI
# from pymongo import MongoClient
# from pydantic import BaseModel
# import random
# import threading
# import time
# from bson import ObjectId
# from fastapi.encoders import jsonable_encoder

# app = FastAPI()

# # Conectar ao MongoDB
# client = MongoClient("mongodb://localhost:27017/")
# db = client["irrigation"]
# collection = db["humidity"]

# class HumidityData(BaseModel):
#     humidity: int
#     remaining: int

# def generate_and_store_data():
#     while True:
#         humidity = random.randint(0, 100)
#         remaining = 100 - humidity
#         data = {"humidity": humidity, "remaining": remaining, "timestamp": time.time()}
#         collection.insert_one(data)
#         time.sleep(5)

# @app.get("/humidity")
# async def get_humidity_data():
#     data = collection.find().sort("_id", -1).limit(1)
#     result = []
#     for item in data:
#         item["_id"] = str(item["_id"])
#         result.append(item)
#     return jsonable_encoder(result)

# # Rota de verificação para listar todos os documentos
# @app.get("/all-humidity")
# async def get_all_humidity_data():
#     data = collection.find()
#     result = []
#     for item in data:
#         item["_id"] = str(item["_id"])
#         result.append(item)
#     return jsonable_encoder(result)

# threading.Thread(target=generate_and_store_data, daemon=True).start()
from fastapi import FastAPI
from fastapi.middleware.cors import CORSMiddleware
from pymongo import MongoClient
from pydantic import BaseModel
import random
import threading
import time
from bson import ObjectId
from fastapi.encoders import jsonable_encoder

app = FastAPI()

# Conectar ao MongoDB
client = MongoClient("mongodb://localhost:27017/")
db = client["irrigation"]
collection = db["humidity"]

class HumidityData(BaseModel):
    humidity: int
    remaining: int

def generate_and_store_data():
    while True:
        humidity = random.randint(0, 100)
        remaining = 100 - humidity
        data = {"humidity": humidity, "remaining": remaining, "timestamp": time.time()}
        collection.insert_one(data)
        time.sleep(5)

@app.get("/humidity")
async def get_humidity_data():
    data = collection.find().sort("_id", -1).limit(1)
    result = []
    for item in data:
        item["_id"] = str(item["_id"])
        result.append(item)
    return jsonable_encoder(result)

@app.get("/all-humidity")
async def get_all_humidity_data():
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

threading.Thread(target=generate_and_store_data, daemon=True).start()
