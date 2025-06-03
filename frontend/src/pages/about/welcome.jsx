const AboutUs = () => {
  return (
    <main className="flex-grow mt-3 pt-4 pb-4 bg-[#0c0c1d] flex items-start justify-start"> {/* Menambahkan margin atas mt-8 */}
      <div className="container mx-auto px-4 flex flex-col items-start text-left">
        {/* Heading with responsive text and spacing */}
        <h1 className="text-4xl md:text-5xl lg:text-4xl font-bold font-sourceSerif text-cyan-200 mb-4 leading-tight">
          TENTANG KAMI
        </h1>
      </div>
    </main>
  );
};

export default AboutUs;
