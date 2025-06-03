# Use official Node.js image
FROM node:20-alpine

# Set working directory
WORKDIR /app

# Copy package.json and package-lock.json
COPY package.json .
COPY frontend/package.json frontend/
COPY frontend/package-lock.json frontend/

# Install dependencies
RUN cd frontend && npm install

# Copy frontend source
COPY frontend /app/frontend

# Build the app
RUN cd frontend && npm run build

# Expose port 5173 (Vite default)
EXPOSE 5173

# Start the app
CMD ["npm", "run", "preview", "--prefix", "frontend", "--", "--host"]
