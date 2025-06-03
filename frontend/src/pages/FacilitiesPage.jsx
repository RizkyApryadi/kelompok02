import React from "react";
import FacilitiesList from './facilities/FacilitiesList';

const FacilitiesPage = () => {
  return (
    <main className="min-h-[calc(100vh-140px)] bg-gray-50">
      <div className="container mx-auto px-4 py-8 text-black">

        {/* Facilities List Section */}
        <section>
          <FacilitiesList />
        </section>
      </div>
    </main>
  );
};

export default FacilitiesPage;