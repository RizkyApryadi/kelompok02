import { useState, useEffect } from "react";
import AOS from "aos";
import "aos/dist/aos.css"; // Import AOS styles

const SuccessAndFAQ = () => {
    useEffect(() => {
        AOS.init({
            duration: 1000, // Animation duration
            easing: "ease-in-out",
            once: true, // Animation will trigger only once
        });
    }, []);

    return (
        <section className="bg-white py-16 px-4">
            {/* Kunci Sukses dalam Belajar */}
            <div className="container mx-auto px-6" data-aos="fade-up">
                <h2 className="text-center text-xl md:text-2xl font-bold mb-6 text-black">
                    Kunci Sukses dalam Belajar :
                </h2>
                <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                    {/* Success Key Cards with hover effects */}
                    <div className="bg-blue-900 hover:bg-blue-800 p-6 rounded-lg text-center text-white transition-all duration-300 transform hover:scale-105 hover:shadow-lg cursor-pointer">
                        <p className="font-bold">Motivasi yang Kuat</p>
                    </div>
                    <div className="bg-red-600 hover:bg-red-500 p-6 rounded-lg text-center text-white transition-all duration-300 transform hover:scale-105 hover:shadow-lg cursor-pointer">
                        <p className="font-bold">Kemampuan Manajemen Waktu</p>
                    </div>
                    <div className="bg-blue-600 hover:bg-blue-500 p-6 rounded-lg text-center text-white transition-all duration-300 transform hover:scale-105 hover:shadow-lg cursor-pointer">
                        <p className="font-bold">
                            Metode Pembelajaran yang Efektif
                        </p>
                    </div>
                    <div className="bg-cyan-500 hover:bg-cyan-400 p-6 rounded-lg text-center text-white transition-all duration-300 transform hover:scale-105 hover:shadow-lg cursor-pointer">
                        <p className="font-bold">Konsistensi dan Disiplin</p>
                    </div>
                </div>
            </div>

            {/* Teks dan daftar poin */}
            <div
                className="flex flex-col md:flex-row items-center justify-between px-8 py-12 bg-white mb-12 mt-20"
                data-aos="fade-left"
            >
                <div className="w-full md:w-1/2 mt-8 md:mt-0 md:ml-40">
                    {" "}
                    {/* Menambahkan margin kiri pada teks */}
                    <h4 className="text-sm font-bold text-white bg-red-600 inline-block px-2 py-1 rounded">
                        Menjawab Tantangan Pembelajaran Gen-Z
                    </h4>
                    <h2 className="text-2xl font-bold text-gray-900 mt-4">
                        Apakah Ini yang Anda Rasakan?
                    </h2>
                    <ul className="mt-4 space-y-2 text-gray-700 list-disc list-inside">
                        <li>Kesulitan mengikuti pembelajaran secara luring?</li>
                        <li>Manajemen Waktu yang buruk dalam pembelajaran</li>
                        <li>Akses terbatas ke sumber pembelajaran</li>
                        <li>
                            Kesulitan ekonomi untuk mendapat pembelajaran dari
                            luar?
                        </li>
                    </ul>
                    <button className="mt-6 bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded">
                        Kontak Admin
                    </button>
                </div>

                {/* Menambahkan margin bawah */}
                <div className="relative w-full md:w-1/2 flex justify-center">
                    <img
                        src="/assets/students.jpg" // Ganti dengan path gambar kamu
                        alt="Ilustrasi Tantangan"
                        className="max-w-md w-full"
                    />
                </div>
            </div>

            {/* Speech Bubbles Section - Bottom Section */}
            <div className="relative flex items-start justify-center mt-40">
                <h1 className="text-black">Solution?</h1>
                {/* Avatar */}
                <img src="/assets/avatar.png" alt="Avatar" className="w-70" />

                {/* Speech bubbles */}
                <div className="ml-[-90px] flex flex-col space-y-3 transform -translate-y-20">
                    {/* Kotak hitam pertama */}
                    <div
                        className="bg-[#070335] text-white text-base px-4 py-2 rounded-lg w-auto"
                        data-aos="fade-up"
                        data-aos-delay="100" // Delay pertama
                    >
                        Gunakan platform e-leaning untuk mengakses pembelajaran
                        secara daring
                    </div>
                    {/* Kotak hitam kedua */}
                    <div
                        className="bg-[#070335] text-white text-base px-4 py-2 rounded-lg w-auto"
                        data-aos="fade-up"
                        data-aos-delay="200" // Delay kedua
                    >
                        Penggunaan Elearning solusi yang bagus karena fleksibel
                        untuk mengaksesnya
                    </div>
                    {/* Kotak hitam ketiga */}
                    <div
                        className="bg-[#070335] text-white text-base px-4 py-2 rounded-lg w-auto"
                        data-aos="fade-up"
                        data-aos-delay="300" // Delay ketiga
                    >
                        Platform yang disediakan tidak memungut biaya apapun
                    </div>
                    {/* Kotak hitam keempat */}
                    <div
                        className="bg-[#070335] text-white text-base px-4 py-2 rounded-lg w-auto"
                        data-aos="fade-up"
                        data-aos-delay="400" // Delay keempat
                    >
                        Platform E-Elearning menjadi solusi yang terbaik dalam
                        hal pembelajaran
                    </div>
                </div>
            </div>
        </section>
    );
};

export default SuccessAndFAQ;
