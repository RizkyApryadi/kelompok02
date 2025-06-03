# Laravel + React Development Setup
# This script helps you run Laravel in Docker and React separately

Write-Host "=== Laravel + React Development Setup ===" -ForegroundColor Green

# Check if Docker is running
try {
    docker version | Out-Null
    Write-Host "✓ Docker is running" -ForegroundColor Green
} catch {
    Write-Host "✗ Docker is not running. Please start Docker Desktop." -ForegroundColor Red
    exit 1
}

# Build and start Laravel in Docker
Write-Host "`n🐳 Starting Laravel backend in Docker (port 8000)..." -ForegroundColor Cyan
docker-compose down
docker-compose up --build -d

# Wait for services to be ready
Write-Host "⏳ Waiting for services to be ready..." -ForegroundColor Yellow
Start-Sleep -Seconds 10

# Check if Laravel is responding
try {
    $response = Invoke-WebRequest -Uri "http://localhost:8000" -UseBasicParsing
    Write-Host "✓ Laravel backend is running on http://localhost:8000" -ForegroundColor Green
} catch {
    Write-Host "⚠ Laravel backend might still be starting up..." -ForegroundColor Yellow
}

Write-Host "`n📋 Next steps:" -ForegroundColor Magenta
Write-Host "1. Open a new terminal and navigate to the frontend directory:"
Write-Host "   cd frontend" -ForegroundColor White
Write-Host "2. Install dependencies (if not already done):"
Write-Host "   npm install" -ForegroundColor White
Write-Host "3. Start the React development server:"
Write-Host "   npm run dev" -ForegroundColor White
Write-Host ""
Write-Host "🌐 URLs:" -ForegroundColor Magenta
Write-Host "- Laravel Backend: http://localhost:8000" -ForegroundColor White
Write-Host "- React Frontend: http://localhost:5173 (Vite default)" -ForegroundColor White
Write-Host ""
Write-Host "📊 Monitor Docker containers:" -ForegroundColor Magenta
Write-Host "   docker-compose logs -f" -ForegroundColor White
Write-Host ""
Write-Host "🛑 To stop Laravel Docker services:" -ForegroundColor Magenta
Write-Host "   docker-compose down" -ForegroundColor White
