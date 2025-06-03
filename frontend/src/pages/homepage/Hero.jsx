import { useEffect, useState } from "react";

const Hero = () => {
  const [isBlackBg, setIsBlackBg] = useState(false);

  useEffect(() => {
    const interval = setInterval(() => {
      setIsBlackBg((prev) => !prev);
    }, 5000);

    return () => clearInterval(interval);
  }, []);

  return (
    <div className="relative">
      <section
        className={`transition-colors duration-1000 ${
          isBlackBg ? "bg-[#070335]" : "bg-[#F0A8C2]"
        } text-white py-0 px-6 min-h-screen`}
      >
        <div className="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-8 md:gap-16 h-full">
          {/* Konten Kiri */}
          <div className="md:w-1/2 text-center md:text-left mt-40"> {/* Menurunkan margin atas ke mt-40 */}
            <h1
              className={`text-4xl md:text-5xl lg:text-6xl font-bold font-sourceSerif leading-tight tracking-tight transition-colors duration-1000 ${
                isBlackBg ? "text-white" : "text-black"
              }`}
            >
              Datang Bermakna, <br /> Pulang Berkarya
            </h1>

            <p
              className={`mt-4 text-lg md:text-xl lg:text-2xl font-medium transition-colors duration-1000 ${
                isBlackBg ? "text-gray-300" : "text-gray-800"
              }`}
            >
              ─── SMAN 1 PARMAKSIAN
            </p>
          </div>

          {/* Avatar dalam Lingkaran */}
    
        </div>

      </section>
      <hr />
    </div>
  );
};

export default Hero;
