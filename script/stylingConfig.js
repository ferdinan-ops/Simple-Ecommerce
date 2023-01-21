tailwind.config = {
   theme: {
      container: {
         screens: {
            sm: "640px",
            md: "768px",
            lg: "1024px",
            xl: "1117px",
         },
      },
      extend: {
         colors: {
            primary: "#FF8A00",
            secondary: "#FFF6E4",
            "black-font": "#2C2C2C",
         },
         fontFamily: {
            sans: ["Poppins", "sans-serif"],
         },
      },
   },
};
