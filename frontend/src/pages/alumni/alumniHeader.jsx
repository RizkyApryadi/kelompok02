const AlumniHeader = () => {
    return (
      <div className="relative w-full">
        {/* Hero Section with responsive height */}
        <div 
          className="relative w-full h-[60vh] min-h-[400px] md:h-[70vh] bg-cover bg-center flex items-center justify-center text-center"
          style={{ 
            backgroundImage: "url('/assets/Alumni.jpg')",
            backgroundAttachment: 'fixed' // Optional parallax effect
          }}
        >
          {/* Dark overlay for better text readability */}
          <div className="absolute inset-0 bg-black bg-opacity-40"></div>
          
          {/* Content container */}
          <div className="relative z-10 px-6 max-w-4xl mx-auto">
            

          </div>
        </div>
  
        {/* Breadcrumb integration space (if needed) */}
        <div className="container mx-auto px-4 -mt-8 relative z-20">
          {/* If you're using the Breadcrumb component, it would go here */}
          {/* <Breadcrumb /> */}
        </div>
      </div>
    );
  };
  
  export default AlumniHeader;