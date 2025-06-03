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

# Build the app
RUN npm run build

# Expose port 5173 (Vite default)
EXPOSE 5173

# Start the app
CMD ["npm", "run", "preview", "--", "--host"]
