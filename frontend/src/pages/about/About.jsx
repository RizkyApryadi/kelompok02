import { useEffect, useState } from "react";
import axios from "axios";

const About = () => {
    const [about, setAbout] = useState("");

    useEffect(() => {
        axios
            .get("http://localhost:8000/api/about") // sesuaikan port
            .then((response) => {
                setAbout(response.data.deskripsi);
            })
            .catch((error) => {
                console.error("Error fetching about:", error);
            });
    }, []);

    return (
        <main className="flex-grow pt-16 pb-10 bg-[#f0f0f0] flex items-center justify-center">
            <div className="flex flex-col lg:flex-row gap-8 max-w-6xl w-full px-4">
                {/* Kotak Deskripsi */}
                <section className="bg-gray-200 p-8 rounded-lg shadow-lg flex-1">
                    <div className="flex flex-col items-center text-center">
                        <div
                            className="prose max-w-none text-gray-700 text-justify"
                            dangerouslySetInnerHTML={{ __html: about }}
                        />
                    </div>
                </section>

                {/* Kotak Akreditasi */}
                <div className="bg-white p-6 rounded-lg shadow-md w-full lg:w-80 flex-shrink-0">
                    <h2 className="text-2xl font-bold text-gray-800 mb-4 text-center">
                        Akreditasi Sekolah
                    </h2>

                    {/* Ikon Sekolah */}
                    <div className="flex justify-center mb-4">
                        <div className="bg-green-500 rounded-full p-4">
                            <svg
                                className="w-12 h-12 text-white"
                                fill="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path d="M12 2L1 7l11 5 9-4.09V17h2V7L12 2zM11 12.13L3.74 8.44 12 4.44l8.26 4-8.26 3.69zM11 14v6H9v-6h2zm4 0v6h-2v-6h2z" />
                            </svg>
                        </div>
                    </div>

                    {/* Info Sekolah */}
                    <div className="text-sm text-gray-700 space-y-2">
                        <p>
                            <span className="font-semibold">Kepsek:</span>{" "}
                            Tumpol Sitorus
                        </p>
                        <p>
                            <span className="font-semibold">Operator:</span>{" "}
                            Jeffri Adventus Siringoringo
                        </p>
                        <p>
                            <span className="font-semibold">Akreditasi:</span>{" "}
                            <span className="text-green-600 font-bold">B</span>
                        </p>
                        <p>
                            <span className="font-semibold">Kurikulum:</span>{" "}
                            Kurikulum Merdeka
                        </p>
                    </div>
                </div>
            </div>
        </main>
    );
};

export default About;
