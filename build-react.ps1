# Build the React app
Write-Host "Building React application..." -ForegroundColor Green
Set-Location frontend
npm install
npm run build

# Copy the build files to Laravel public directory
Write-Host "Copying build files to Laravel public directory..." -ForegroundColor Green
Set-Location ..
if (Test-Path "public/react") {
    Remove-Item -Recurse -Force "public/react"
}
New-Item -ItemType Directory -Path "public/react" -Force
Copy-Item -Recurse "frontend/dist/*" "public/react/"

Write-Host "React build copied successfully!" -ForegroundColor Green
Write-Host "You can now access the app via port 8000" -ForegroundColor Yellow
