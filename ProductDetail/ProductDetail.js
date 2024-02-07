const stars = document.querySelectorAll(".star");
const reviewText = document.getElementById("review");
const submitBtn = document.getElementById("submit");
const reviewsContainer = document.getElementById("reviews");
const ratingProgressBar = document.querySelectorAll(".done");
const reviewForm = document.getElementById("reviewForm");

let rating;

ratingProgressBar.forEach((bar, index) => {
    let ratingCountAll = document.getElementById("ratingCountAll").innerText.split(" ")[0];
    let ratingCount;
    let ratingCountRatio;
    if(bar.id == index){
        ratingCount = bar.innerText;
        ratingCountRatio = ratingCount / ratingCountAll * 100;
        bar.setAttribute("style",`width:${ratingCountRatio}%`);
    }
});
 
stars.forEach((star) => {
    star.addEventListener("click", () => {
        const value = parseInt(star.getAttribute("data-value"));
        document.getElementById('hiddenValue').value = value;
        rating = value;
 
        stars.forEach((s) => s.classList.remove("one", "two", "three", "four", "five"));

        stars.forEach((s, index) => {
            if (index < value) {
                s.classList.add(getStarColorClass(value));
            }
        });
 
        stars.forEach((s) => s.classList.remove("selected"));
        star.classList.add("selected");
    });
});
 
submitBtn.addEventListener("click", () => {
    const review = reviewText.value;
    const userRating = rating;

    if (!userRating || !review) {
        alert("Please select a rating and provide a review before submitting.");
        return;
    }
    if (userRating > 0) {
        stars.forEach((s) => s.classList.remove("one", "two",  "three", "four", "five", "selected"));
    }
});
 
function getStarColorClass(value) {
    switch (value) {
        case 1:
            return "one";
        case 2:
            return "two";
        case 3:
            return "three";
        case 4:
            return "four";
        case 5:
            return "five";
        default:
            return "";
    }
}
