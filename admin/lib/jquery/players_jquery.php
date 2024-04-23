<link rel="stylesheet" type="text/css" href="../lib/jquery/dataTables.dataTables.min.css">
<script src="../lib/jquery/jquery-3.7.1.min.js"></script>
<script src="../lib/jquery/dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#players-table-data').DataTable({
            initComplete: function() {
                this.api().columns().every(function() {
                    var column = this;
                    var header = $(column.header());
                    header.css('text-align', 'center'); // Középre igazítja a fejlécet

                    // Ellenőrizzük, hogy a fejléc tartalmazza-e az ikont, és ha igen, középre igazítjuk
                    if (header.find('.sorting').length > 0 || header.find('.sorting_asc').length > 0 || header.find('.sorting_desc').length > 0) {
                        header.css('justify-content', 'center');
                    }
                });
            }
        });
    });
</script>