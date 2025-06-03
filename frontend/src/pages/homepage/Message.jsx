import { useState, useEffect } from "react";
import AOS from "aos";
import "aos/dist/aos.css"; // Import AOS styles
import { section } from "framer-motion/client";

const SuccessAndFAQ = () => {
    useEffect(() => {
        AOS.init({
            duration: 1000, // Animation duration
            easing: "ease-in-out",
            once: true, // Animation will trigger only once
        });
    }, []);

    return (
       <section>

      

       </section>
    );
};

export default SuccessAndFAQ;
