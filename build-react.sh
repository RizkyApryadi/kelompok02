#!/bin/bash

# Build the React app
echo "Building React application..."
cd frontend
npm install
npm run build

# Copy the build files to Laravel public directory
echo "Copying build files to Laravel public directory..."
cd ..
rm -rf public/react
mkdir -p public/react
cp -r frontend/dist/* public/react/

echo "React build copied successfully!"
echo "You can now access the app via port 8000"
