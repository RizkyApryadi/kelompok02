<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>E-LEARNING SMAN 1 PARMAKSIAN</title>
  <style>
    /* Main container styling */
    .main-container {
      width: 1000px;
      /* Increased width */
      height: 600px;
      /* Increased height */
      position: relative;
      background: white;
      border-radius: 0.5rem;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }

    /* Slider and forgot password container */
    .content-container {
      width: 100%;
      height: 100%;
      position: relative;
    }

    /* Slider styling */
    #slider {
      display: flex;
      width: 200%;
      height: 100%;
      transition: transform 0.5s ease-in-out;
    }

    /* Each panel takes half of slider */
    .slider-panel {
      width: 50%;
      height: 100%;
      display: flex;
    }

    /* Forgot password styling */
    #forgot-password {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      display: none;
      background: white;
    }

    /* Common panel styling */
    .form-panel {
      width: 100%;
      /* Fill entire width */
      padding: 3rem;
      /* Increased padding */
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    .gradient-panel {
      background: linear-gradient(to bottom, #50A7B5, #ABFFFC);
      color: white;
      border-radius: 0 100px 100px 0;
    }

    /* Input styling */
    .input-container {
      position: relative;
      width: 100%;
      margin-bottom: 1.5rem;
      /* Increased margin */
    }

    .input-field {
      width: 100%;
      padding: 1rem;
      /* Increased padding */
      padding-left: 2.5rem;
      border: 1px solid #e5e7eb;
      border-radius: 0.375rem;
      background-color: #f9fafb;
      outline: none;
    }

    .input-field:focus {
      ring: 2px;
      ring-color: #50A7B5;
    }

    .input-icon {
      position: absolute;
      left: 0.75rem;
      top: 50%;
      transform: translateY(-50%);
      color: #6b7280;
    }

    /* Button styling */
    .btn-primary {
      width: 100%;
      padding: 0.75rem;
      /* Increased padding */
      background-color: #50A7B5;
      color: white;
      border-radius: 0.375rem;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
      transition: all 0.2s;
    }

    .btn-primary:hover {
      background-color: #3e8d9b;
    }

    .btn-secondary {
      padding: 0.75rem 1.5rem;
      background-color: #50A7B5;
      color: white;
      border-radius: 0.375rem;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
      transition: all 0.2s;
    }

    .btn-secondary:hover {
      background-color: #f3f4f6;
      color: #50A7B5;
    }
  </style>
</head>

<body class="flex items-center justify-center h-screen bg-gray-300">
  <div class="main-container" id="container">
    <div class="content-container">
      <!-- Main Login/Register Slider -->
      <div id="slider">
        <!-- Login Section -->
        <div class="slider-panel">
          <div class="form-panel gradient-panel">
            <img src="assets/logo.png" alt="Logo" class="w-20 mb-4">
            <h2 class="text-xl font-bold">E-LEARNING</h2>
            <h3 class="text-lg">SMAN 1 PARMAKSIAN</h3>
          </div>
          <div class="form-panel">
            <h2 class="text-3xl font-bold mb-6">LOGIN</h2> <!-- Increased font size -->

            <form method="POST" action="{{ route('login') }}">
              @csrf
              <div>
                  <!-- Input Username -->
                  <div class="mb-3">
                      <input id="email" placeholder="Username" type="email"
                          class="w-full px-8 py-2 text-lg border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#50A7B5] @error('email') border-red-500 @enderror"
                          name="email" value="{{ old('email') }}" required autofocus>
                      
                      <!-- Menampilkan pesan error untuk email -->
                      @error('email')
                          <span class="text-sm text-red-500" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
          
                  <!-- Input Password -->
                  <div class="mb-3">
                      <input id="password" placeholder="Password" type="password"
                          class="w-full px-8 py-2 text-lg border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#50A7B5] @error('password') border-red-500 @enderror"
                          name="password" tabindex="2" required autocomplete="current-password">
                      
                      <!-- Menampilkan pesan error untuk password -->
                      @error('password')
                          <span class="text-sm text-red-500" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
          
                  <!-- Submit Button -->
                  <div class="mb-6">
                      <button type="submit"
                          class="w-full px-6 py-2 text-lg bg-[#50A7B5] text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                          Login
                      </button>
                  </div>
              </div>
          </form>
          

          </div>
        </div>
      </div>
    </div>
  </div>

</body>

</html>