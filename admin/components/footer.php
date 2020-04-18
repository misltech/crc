</div>
  </div>
  <!-- Bootstrap core JavaScript -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html5sortable/0.9.17/html5sortable.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/v/bs4/dt-1.10.20/b-1.6.1/r-2.2.3/datatables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

  <script type="text/javascript">
  $(".source li").draggable({
  addClasses: false,
  appendTo: "body",
  helper: "clone"
});
 
$(".target").droppable({
  addClasses: false,
  activeClass: "listActive",
  accept: ":not(.ui-sortable-helper)",
  drop: function(event, ui) {
    $(this).find(".placeholder").remove();
    var link = $("<a href='#' class='dismiss'>x</a>");
    var list = $("<li></li>").text(ui.draggable.text());
    $(list).append(link);
    $(list).appendTo(this);
    updateValues();
  }
}).sortable({
  items: "li:not(.placeholder)",
  sort: function() {
    $(this).removeClass("listActive");
  },
  update: function() {
    updateValues();
  }
}).on("click", ".dismiss", function(event) {
  event.preventDefault();
  $(this).parent().remove();
  updateValues();
});
</script>

  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });


    $(document).ready(function() {
    $('#worktbl').DataTable();
      } );
  </script>

</body>

</html>