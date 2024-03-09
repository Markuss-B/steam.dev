# How to Run the Project for the First Time

## Prerequisites

- Ensure Docker is installed on your system.

## Setup Instructions

1. **Clone the Project**
    - Use Git to clone the project repository to your local machine.

2. **Start Docker Containers**
    - Open a terminal in the project's root directory.
    - Execute the following command to build and start the Docker containers in detached mode:
      ```
      docker-compose up -d --build
      ```

3. **Initialize the Project**
    - Run the following commands to set up the project environment:
      - Install Composer dependencies:
        ```
        docker-compose run --rm composer install
        ```
      - Generate an application key:
        ```
        docker-compose run --rm artisan key:generate
        ```
      - Run database migrations:
        ```
        docker-compose run --rm artisan migrate
        ```
      - Seed the database:
        ```
        docker-compose run --rm artisan db:seed
        ```
      - Install NPM packages:
        ```
        docker-compose run --rm npm install
        ```

4. **Run the Project**
    - To start the project in development mode, run:
      ```
      docker-compose run --rm --service-ports npm run dev
      ```
    - To build the project for production, run:
      ```
      docker-compose run --rm npm run build
      ```

- You can now access the project at [http://localhost:8080](http://localhost:8080).

## Turning Off the Project

- To stop and remove the Docker containers, run:
  ```
  docker-compose down
  ```

# How to Run the Project After the First Time

1. **Start Docker Containers**
    - Open a terminal in the project's root directory.
    - Execute the following command to start the Docker containers in detached mode:
      ```
      docker-compose up -d
      ```

2. **Run the Project**
    - To start the project in development mode, run:
      ```
      docker-compose run --rm --service-ports npm run dev
      ```
    - To build the project for production, run:
      ```
      docker-compose run --rm npm run build
      ```