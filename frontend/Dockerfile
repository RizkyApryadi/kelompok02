# Use official Node.js image
FROM node:20-alpine

# Set working directory
WORKDIR /app

# Copy package.json and package-lock.json
COPY package.json .
COPY package-lock.json ./

# Install dependencies
RUN npm install

# Copy frontend source
COPY . .

# Build the app for production
RUN npm run build

# The build output will be in /app/dist
# This will be mounted to /public/react in the backend container
