

    function openPopupUPF(film) {
        var overlay = document.getElementById("shadow");
        var popup = document.getElementById("popupUF");

        overlay.style.display = "flex";
        popup.style.display = "block";

        // Utiliser les données du film pour remplir le formulaire
        document.getElementById('id').value = film.id_acte_depense;
        document.getElementById('type').value = film.nom;
        document.getElementById('cent').value = film.budget;
    }

    function closePopupF() {
        var overlay = document.getElementById("shadow");
        var popup = document.getElementById("popupUF");

        overlay.style.display = "none";
        popup.style.display = "none";
    }

    

    function openPopup(film) {
        var overlay = document.getElementById("shadow");
        var popup = document.getElementById("popupUF");

        overlay.style.display = "flex";
        popup.style.display = "block";

        // Utiliser les données du film pour remplir le formulaire
        document.getElementById('id').value = film.id_acte_depense;
        document.getElementById('type').value = film.nom;
        document.getElementById('cent').value = film.budget;
    }

    function closePopup() {
        var overlay = document.getElementById("shadow");
        var popup = document.getElementById("popupUF");

        overlay.style.display = "none";
        popup.style.display = "none";
    }

