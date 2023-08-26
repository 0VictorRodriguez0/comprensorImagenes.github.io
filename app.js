let input = document.getElementById('input');
const WIDTH = 800;

let compressedImageLink = document.createElement('a'); 
compressedImageLink.style.display = 'none'; 
document.getElementById('wrapper').appendChild(compressedImageLink);

input.addEventListener("change", (event) => {
    let image_file = event.target.files[0];

    console.log("Original File", image_file);

    let reader = new FileReader();

    reader.readAsDataURL(image_file);

    reader.onload = (event) => {

        let image = new Image();
        image.src = event.target.result;

        image.onload = () => {

            let canvas = document.createElement('canvas');
            let ratio = WIDTH / image.width;
            canvas.width = WIDTH;
            canvas.height = image.height * ratio;

            let context = canvas.getContext('2d');
            context.drawImage(image, 0, 0, canvas.width, canvas.height);

            let new_image_url = canvas.toDataURL('image/jpeg', 0.5); 

            const imageName = prompt("Enter a name for the compressed image:", "Compressed_Image");

            if (imageName !== null) {
                compressedImageLink.href = new_image_url;
                compressedImageLink.download = `${imageName}.jpg`;
                compressedImageLink.innerHTML = `Download ${imageName}`;
                compressedImageLink.style.display = 'block';
            }
        };
    };
});
