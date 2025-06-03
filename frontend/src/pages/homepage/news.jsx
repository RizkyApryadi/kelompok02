import { useEffect, useState } from "react";
import axios from "axios";
import AOS from "aos";
import "aos/dist/aos.css";

const ITEMS_PER_PAGE = 3;

const NewsCard = () => {
    const [newsList, setNewsList] = useState([]);
    const [currentPage, setCurrentPage] = useState(1);
    const [selectedNews, setSelectedNews] = useState(null);

    useEffect(() => {
        AOS.init({
            duration: 1000,
            easing: "ease-out",
            once: true,
        });

        axios
            .get("http://localhost:8000/api/news")
            .then((res) => {
                const sortedNews = res.data.sort(
                    (a, b) => new Date(b.date) - new Date(a.date)
                );
                setNewsList(sortedNews);
            })
            .catch((err) => console.error("Error fetching news:", err));
    }, []);

    if (newsList.length === 0) return <div>Loading berita...</div>;

    const totalPages = Math.ceil(newsList.length / ITEMS_PER_PAGE);

    const visibleNews = newsList.slice(
        (currentPage - 1) * ITEMS_PER_PAGE,
        currentPage * ITEMS_PER_PAGE
    );

    const closeModal = () => setSelectedNews(null);

    return (
        <div className="w-full min-h-screen bg-gray-100 p-4 sm:p-6 relative">
            <div className="mb-6 sm:mb-8 w-full text-left">
                <h2 className="text-2xl font-bold text-black">
                    Berita Terkini
                </h2>
            </div>

            <div className="flex space-x-6 overflow-x-auto scrollbar-hide px-6">
                {visibleNews.map((news, index) => (
                    <div
                        key={index}
                        className="flex-shrink-0 w-[350px] sm:w-[400px] bg-white rounded-lg shadow-lg overflow-hidden"
                        data-aos="fade-left"
                        style={{ minWidth: "350px" }}
                    >
                        <div className="w-full h-48 sm:h-56 md:h-64 bg-gray-300 relative">
                            <img
                                src={`http://localhost:8000/storage/${news.photo.replace(
                                    "public/",
                                    ""
                                )}`}
                                alt={news.title}
                                className="w-full h-full object-cover"
                            />
                            <div className="absolute bottom-0 left-0 bg-blue-600 text-white px-3 py-1 text-sm font-medium">
                                {new Date(news.date).toLocaleDateString(
                                    "id-ID",
                                    {
                                        day: "numeric",
                                        month: "long",
                                        year: "numeric",
                                    }
                                )}
                            </div>
                        </div>

                        <div className="p-4 sm:p-6">
                            <div className="flex items-center mb-3">
                                <div className="h-5 w-1 bg-blue-600 mr-2"></div>
                                <span className="text-blue-600 font-semibold text-sm uppercase tracking-wider">
                                    BERITA TERKINI
                                </span>
                            </div>

                            <h2 className="text-xl sm:text-2xl font-bold text-gray-800 leading-tight mb-3">
                                {news.title}
                            </h2>

                            <p className="text-gray-600 leading-relaxed mb-4">
                                {news.description.length > 200
                                    ? `${news.description.substring(0, 200)}...`
                                    : news.description}
                            </p>

                            <div className="flex justify-end">
                                <button
                                    onClick={() => setSelectedNews(news)}
                                    className="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-300 flex items-center text-sm"
                                >
                                    Baca Selengkapnya
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        className="h-4 w-4 ml-1"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            strokeLinecap="round"
                                            strokeLinejoin="round"
                                            strokeWidth={2}
                                            d="M14 5l7 7m0 0l-7 7m7-7H3"
                                        />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                ))}
            </div>

            {/* Pagination */}
            <div className="flex justify-center space-x-4 mt-6">
                {[...Array(totalPages)].map((_, index) => {
                    const pageNum = index + 1;
                    return (
                        <button
                            key={index}
                            onClick={() => setCurrentPage(pageNum)}
                            className={`w-8 h-8 rounded-full font-semibold text-sm 
                                flex items-center justify-center border transition 
                                ${
                                    pageNum === currentPage
                                        ? "bg-blue-600 text-white border-blue-600"
                                        : "bg-white text-gray-700 border-gray-300 hover:bg-gray-100"
                                }`}
                            aria-label={`Halaman berita nomor ${pageNum}`}
                        >
                            {pageNum}
                        </button>
                    );
                })}
            </div>

            {/* Modal */}
            {selectedNews && (
                <div
                    className="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60 px-4"
                    onClick={closeModal} // Tutup modal jika klik pada backdrop
                >
                    <div
                        className="bg-white rounded-xl max-w-3xl w-full p-6 sm:p-8 relative shadow-xl animate-fadeIn"
                        onClick={(e) => e.stopPropagation()} // Cegah close saat klik konten
                    >
                        {/* Tombol Close */}
                        <button
                            onClick={closeModal}
                            className="absolute top-4 right-4 text-gray-500 hover:text-gray-800 text-3xl font-light leading-none focus:outline-none"
                            style={{
                                background: "transparent",
                                border: "none",
                            }}
                            aria-label="Tutup"
                        >
                            ×
                        </button>

                        {/* Judul */}
                        <h2 className="text-2xl sm:text-3xl font-bold mb-4 text-gray-800">
                            {selectedNews.title}
                        </h2>

                        {/* Gambar */}
                        <div className="w-full flex justify-center mb-4">
                            <div className="w-64 h-64 rounded-lg overflow-hidden">
                                <img
                                    src={`http://localhost:8000/storage/${selectedNews.photo.replace(
                                        "public/",
                                        ""
                                    )}`}
                                    alt={selectedNews.title}
                                    className="w-full h-full object-cover"
                                />
                            </div>
                        </div>

                        {/* Tanggal */}
                        <p className="text-sm text-gray-500 mb-3">
                            {new Date(selectedNews.date).toLocaleDateString(
                                "id-ID",
                                {
                                    day: "numeric",
                                    month: "long",
                                    year: "numeric",
                                }
                            )}
                        </p>

                        {/* Deskripsi */}
                        <p className="text-gray-700 leading-relaxed whitespace-pre-line">
                            {selectedNews.description}
                        </p>

                        {selectedNews.file &&
                            selectedNews.file.trim() !== "" && (
                                <div className="mt-4">
                                    <a
                                        href={`http://localhost:8000/storage/${selectedNews.file.replace(
                                            "public/",
                                            ""
                                        )}`}
                                        download
                                        className="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium underline text-sm"
                                    >
                                        📄 Unduh File:{" "}
                                        {selectedNews.file.split("/").pop()}
                                    </a>
                                </div>
                            )}
                    </div>
                </div>
            )}
        </div>
    );
};

export default NewsCard;
