import { useEffect, useState, useRef } from "react";
import axios from "axios";
import AOS from "aos"; // Import AOS
import "aos/dist/aos.css"; // Import CSS untuk AOS

const PrincipalMessage = () => {
    const [data, setData] = useState([]);
    const [isVisible, setIsVisible] = useState(false); // State untuk visibilitas
    const sectionRef = useRef(null); // Reference untuk elemen section

    useEffect(() => {
        axios
            .get("http://localhost:8000/api/heroes") // Ambil semua data
            .then((response) => setData(response.data))
            .catch((error) => console.error(error));

        // Inisialisasi AOS
        AOS.init({
            duration: 1000,
            easing: "ease-in-out",
            once: true,
        });

        // Intersection Observer untuk mendeteksi apakah elemen terlihat
        const observer = new IntersectionObserver(
            ([entry]) => {
                if (entry.isIntersecting) {
                    setIsVisible(true); // Jika elemen terlihat, set isVisible ke true
                } else {
                    setIsVisible(false); // Jika elemen tidak terlihat, set isVisible ke false
                }
            },
            { threshold: 0.5 } // Elemen dianggap terlihat jika 50% dari elemen tersebut berada di viewport
        );

        // Mulai observasi terhadap elemen section
        if (sectionRef.current) {
            observer.observe(sectionRef.current);
        }

        return () => {
            if (sectionRef.current) {
                observer.unobserve(sectionRef.current); // Bersihkan observer saat komponen unmount
            }
        };
    }, []);

    if (data.length === 0) return <div>Loading...</div>;

    const latest = data[data.length - 1];

    return (
        <section
            ref={sectionRef} // Menambahkan ref pada elemen section
            className={`bg-white py-16 px-4 transition-all duration-1000 ${
                isVisible ? "opacity-100" : "opacity-100"
            }`}
        >
            <div className="max-w-4xl mx-auto">
                <h2
                    className="text-2xl font-bold text-black text-center mb-6" // Menambahkan margin bawah
                    data-aos="fade-up"
                >
                    Sambutan Kepala Sekolah SMAN1 Parmaksian
                </h2>
                <div
                    className="flex flex-col md:flex-row items-center justify-center mt-6 gap-6 md:gap-8"
                    data-aos="fade-left"
                >
                    <img
                        src={`http://localhost:8000/storage/${latest.photo.replace(
                            "public/",
                            ""
                        )}`}
                        alt="Kepala Sekolah"
                        className="rounded-lg w-full max-w-xs object-contain"
                        style={{ background: "transparent" }} // Pastikan tidak ada background
                        data-aos="zoom-in"
                    />

                    <div className="text-gray-700 text-left">
                        <p data-aos="fade-up">{latest.message}</p>{" "}
                        {/* Ini berada di atas */}
                        <p className="mt-4 font-semibold" data-aos="fade-up">
                            {latest.headmaster_name}
                        </p>{" "}
                        {/* Ini berada di bawah */}
                    </div>
                </div>
            </div>
        </section>
    );
};

export default PrincipalMessage;
