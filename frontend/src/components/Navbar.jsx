import { useState, useEffect, useRef } from "react";
import { Link, useLocation } from "react-router-dom";

const Navbar = () => {
    const [isScrolled, setIsScrolled] = useState(false);
    const [isOpen, setIsOpen] = useState(false);
    const navRef = useRef();
    const location = useLocation();

    useEffect(() => {
        const handleScroll = () => {
            setIsScrolled(window.scrollY > 0);
        };

        window.addEventListener("scroll", handleScroll);
        return () => {
            window.removeEventListener("scroll", handleScroll);
        };
    }, []);

    const toggleMenu = () => {
        setIsOpen(!isOpen);
    };

    return (
        <>
            <nav
                ref={navRef}
                className={`fixed w-full z-50 h-16 transition-all ${"bg-[#070335]"}`}
            >
                <div className="container mx-auto flex justify-between items-center h-full px-4">
                    <Link to="/" className="flex items-center h-full">
                        <img
                            src="/assets/logo.png"
                            alt="Logo"
                            className="h-full w-auto"
                        />
                    </Link>

                    {/* Mobile menu button */}
                    <div className="md:hidden">
                        <button
                            onClick={toggleMenu}
                            className="text-white focus:outline-none"
                        >
                            {isOpen ? "✖" : "☰"}
                        </button>
                    </div>

                    {/* Navigation menu */}
                    <div
                        className={`md:flex md:items-center ${
                            isOpen
                                ? "block absolute top-16 right-0 w-64 bg-[#14142b]/90 rounded-lg shadow-lg p-4"
                                : "hidden"
                        } md:static md:bg-transparent md:shadow-none md:p-0 md:w-auto`}
                    >
                        <ul className="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-4 text-sm">
                            {[
                                { path: "/", label: "HOME" },
                                { path: "/about", label: "ABOUT" },
                                { path: "/facilities", label: "FACILITIES" },
                                { path: "/gallery", label: "PRESTASI" },
                                { path: "/location", label: "LOCATION" },
                                { path: "/alumni", label: "ALUMNI" },
                            ].map(({ path, label }) => (
                                <li key={path}>
                                    <Link
                                        to={path}
                                        className={`block text-white py-2 px-4 rounded-lg transition-all duration-300 ${
                                            location.pathname === path
                                                ? "bg-yellow-400 text-black font-semibold"
                                                : "hover:bg-yellow-400 hover:text-black"
                                        }`}
                                        onClick={() => setIsOpen(false)}
                                    >
                                        {label}
                                    </Link>
                                </li>
                            ))}
                            {/* Tombol Login */}
                            <a
                                href="/login"
                                className="block text-white py-2 px-4 rounded-lg border border-yellow-400 hover:bg-yellow-400 hover:text-black transition-all duration-300"
                            >
                                LOGIN
                            </a>
                        </ul>
                    </div>
                </div>
            </nav>

            {/* Garis putih di bawah navbar */}
            <div className="w-full h-0.5 bg-white"></div>
        </>
    );
};

export default Navbar;
