(function (Drupal) {
  Drupal.behaviors.rickAndMorty = {
    attach: (context, settings) => {
      /* SHOWING ALL DATA ABOUT THE CHARACTER */
      hide = (index) => {
        let image = document.getElementById(`image__${index}`);
        let description = document.getElementById(`description__${index}`);
        let allData = document.getElementById(`allData__${index}`);
        image.classList.remove("rotateIn");
        image.classList.add("rotateOut");
  
        description.classList.remove("rotateIn");
        description.classList.add("rotateOut");
  
        allData.classList.remove("rotateOut");
        allData.classList.add("rotateIn");
  
  
        allData.parentElement.classList.add("descriptionIn");
        allData.parentElement.classList.remove("descriptionOut");
      };
  
      /* SHOWING THE PICTURE */
      show = (index) => {
        let image = document.getElementById(`image__${index}`);
        let description = document.getElementById(`description__${index}`);
        let allData = document.getElementById(`allData__${index}`);
        image.classList.remove("rotateOut");
        image.classList.add("rotateIn");
  
        description.classList.remove("rotateOut");
        description.classList.add("rotateIn");
  
        allData.classList.remove("rotateIn");
        allData.classList.add("rotateOut");
  
  
        allData.parentElement.classList.remove("descriptionIn");
        allData.parentElement.classList.add("descriptionOut");
      };
    }
  }
})(Drupal);