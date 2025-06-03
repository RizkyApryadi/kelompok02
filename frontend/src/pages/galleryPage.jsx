import React from "react";
import PrestasiGaleri from "./galeri/prestasiGaleri"; // Sesuaikan nama file jika perlu

const GalleryPage = () => {
  return (
    <main className="min-h-[calc(100vh-140px)] bg-gray-50">
      <div className="container mx-auto px-4 py-8 text-black">    

        {/* Table Section */}
        <section>
          <PrestasiGaleri />
        </section>
      </div>
    </main>
  );
};

export default GalleryPage;