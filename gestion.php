<?php
include_once 'header.php';

?>

    <div class="container-fluid mt-4 pt-5">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header text-white"  style="background-color:rgb(61,131,97,1);">
                      <b> Gestion du Projet</b>
                    </div>
                    <div class="card-body bg-dark">
                        <form  action="./includes/gestion-inc.php" id="circuittouristForm" style="background-color: rgb(201, 216, 214);" method="post">
                            <div class="form-row" style="background-color: rgb(201, 216, 214);">
                                <span class="form-control text-center bg-dark text-white"><b>Identification Circuit</b></span>
                                <div class="form-group col-md-6">
                                    <label for="dategestion">Date Gestion</label>
                                    <input type="date" class="form-control" id="dategestion" name="dategestion" placeholder="date de gestion">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="duree">Duree </label>
                                    <input type="text" class="form-control" id="duree" placeholder="duree">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="id_amenagement">Identifiant_amenagement</label>
                                    <input type="text" class="form-control" id="id_amenagement" placeholder="id_amenagement">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="id_elementamengt">Id_Element_amenagement </label>
                                    <input type="text" class="form-control" id="id_elementamengt" placeholder="id_elementamengt">
                                </div>
                                <!-- <div class="form-group col-md-12">
                                    <label for="detailamenagement">detailamenagement</label>
                                    <input type="text" class="form-control" id="detailamenagement" placeholder="detailamenagement">
                                </div> -->
                            </div>
                            <div class="form-row">
                                
                    
                                <div class="input-group col-md-12">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Detail Amenagement</span>
                                    </div>
                                    <textarea name="detailamenagement" class="form-control" id="detailamenagement" aria-label="detailamenagement" placeholder="Entrer un detailamenagement /description de l'especes"></textarea>
                                </div>
                            </div>
                            <button type="submit" name="submit" class="btn"  style="background-color:rgb(61,131,97,1);">Inserer</button>
                        </form>

                    </div>
                </div>
            </div>
           
            <div class="col-md-6">
                <table class="table table-striped">
                    <thead class="table-success">
                        <tr >
                            <th>Date gestion</th>
                            <th>Duree</th>
                            <th>Id amenagement</th>
                            <th>Element amenagement</th>
                            <th>Detail Amenagement</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="circuitTable" class="table table-white bg-white text-dark table-striped" >
                        <!-- Table rows will be dynamically added here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div> 

     <script>
        // JavaScript code to handle form submission and table population
        document.getElementById("circuittouristForm").addEventListener("submit", function(event) {
          event.preventDefault();
          const dategestion = document.getElementById("dategestion").value;
          const duree = document.getElementById("duree").value;
          const id_amenagement = document.getElementById("id_amenagement").value;
          const id_elementamengt = document.getElementById("id_elementamengt").value;
          const detailamenagement = document.getElementById("detailamenagement").value;

          // Create a new row for the table
          const newRow = document.createElement("tr");
          newRow.innerHTML = `
            <td>${dategestion}</td>
            <td>${duree}</td>
            <td>${id_amenagement}</td>
            <td>${id_elementamengt}</td>
            <td>${detailamenagement}</td>
            <td>
              <button class="btn btn-info btn-sm" onclick="editRow(this)">Edit</button>
            </td>
            <td>
              <button class="btn btn-info btn-sm" onclick="deleteRow(this)">Edit</button>
            </td>
          `;

          // Add the new row to the table
          const tableBody = document.getElementById("circuitTable");
          tableBody.appendChild(newRow);

          // Clear the form inputs after submission
          document.getElementById("circuittouristForm").reset();
        });

        // Function to handle editing a row
        function editRow(button) {
          const row = button.closest("tr");
          const dategestion = row.cells[0].textContent;
          const duree = row.cells[1].textContent;
          const id_amenagement = row.cells[2].textContent;
          const id_elementamengt = row.cells[3].textContent;
          const detailamenagement = row.cells[4].textContent;

          // Populate the form with the data of the selected row
          document.getElementById("dategestion").value = dategestion;
          document.getElementById("duree").value = duree;
          document.getElementById("id_amenagement").value = id_amenagement;
          document.getElementById("id_elementamengt").value = id_elementamengt;
          document.getElementById("detailamenagement").value = detailamenagement;
          // Remove the row from the table
          row.remove();
        }
        //function to handle the deleting row
        function deleteRow(button){
            const row =  button.closest("tr");
          row.remove();
       
        }
    </script>

<?php
   include_once 'footer.php';
   
   ?>














