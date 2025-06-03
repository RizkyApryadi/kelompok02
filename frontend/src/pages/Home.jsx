import Hero from "./homepage/Hero";
import PrincipalMessage from "./homepage/PrincipalMessage";
import NewsCard from "./homepage/News";
import Aktifitas from "./homepage/Aktifitas";
import Testimonials from "./homepage/Testimonials";
import Message from "./homepage/Message";

const Home = () => {
  return (
    <div className="font-sans">
      <Hero />
      <PrincipalMessage />
      <NewsCard />
      <Testimonials />
      <Aktifitas />
      <Message />
    </div>
  );
};

export default Home;
