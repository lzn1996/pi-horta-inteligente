# PI Horta Inteligente

Este projeto é um sistema de irrigação inteligente que utiliza MongoDB, PHP, MySQL e FastAPI. Futuramente, haverá uma integração com Arduino para medir e monitorar a umidade do solo.

## Tecnologias Utilizadas

- **MongoDB**: Banco de dados NoSQL para armazenar dados de umidade.
- **PHP**: Linguagem de programação para desenvolvimento web.
- **MySQL**: Banco de dados relacional.
- **FastAPI**: Framework web para construir APIs rápidas e eficientes.
- **Chart.js**: API para criar gráficos.
- **Open Weather Map**: API para cunsultar o clima.
- **Arduino**: Microcontrolador para medir a umidade do solo (futuro).

## Estrutura do Projeto

O projeto é dividido em diferentes componentes que interagem entre si:

- **Backend:**
  - FastAPI
  - MongoDB
  - Python
  - PHP

- **Frontend:**
  - Bootstrap
  - Chart.js
  - Open Weather Map

## Configuração do Ambiente de Desenvolvimento

### Pré-requisitos

- Python 3.8 ou superior
- PHP 7.4 ou superior
- MongoDB
- MySQL
- Composer (para gerenciar dependências do PHP)
- Virtualenv (opcional, mas recomendado)

### Passos para Configuração

1. Clone o repositório:

   ```bash
   git clone https://github.com/lzn1996/pi-horta-inteligente.git
   cd pi-horta-inteligente
   ```

### Configure o ambiente virtual para Python (opcional, mas recomendado):
   ```bash
     python -m venv venv
    source venv/bin/activate  # No Windows use `venv\Scripts\activate`
   ```

### Instale as dependências do Python:
   ```bash
    pip install fastapi pymongo pydantic uvicorn

   ```
### Configure o MongoDB:

Certifique-se de que o MongoDB esteja instalado e em execução. Crie o banco de dados irrigation e a coleção humidity.

### Inicie o servidor FastAPI:
   ```bash
   uvicorn app:app --reload

   ```

### Configure o PHP e MySQL:

* Instale o WAMP ou Laragon
* Crie um banco de dados MySQL com o nome smartgarden_db
* Crie um arquivo .env com variaveis de ambiente.

Ex: 
SQL_DB_NAME = smartgarden_db
SQL_DB_HOST = localhost
SQL_PORT = 3306
SQL_DB_USERNAME = root


### Instale as dependências do PHP:

   ```bash
   composer install
   ```

### Futuras melhorias

* Integração com Arduino para medir a umidade do solo.
* Adição de mais funcionalidades ao frontend.
* Melhorias na segurança e performance.
