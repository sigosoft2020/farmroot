<script src="<?=base_url()?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>plugins/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="<?=base_url()?>plugins/datatables/dataTables.buttons.min.js"></script>
<script src="<?=base_url()?>plugins/datatables/buttons.bootstrap4.min.js"></script>
<script src="<?=base_url()?>plugins/datatables/jszip.min.js"></script>
<script src="<?=base_url()?>plugins/datatables/pdfmake.min.js"></script>
<script src="<?=base_url()?>plugins/datatables/vfs_fonts.js"></script>
<script src="<?=base_url()?>plugins/datatables/buttons.html5.min.js"></script>
<script src="<?=base_url()?>plugins/datatables/buttons.print.min.js"></script>
<script src="<?=base_url()?>plugins/datatables/dataTables.responsive.min.js"></script>
<script src="<?=base_url()?>plugins/datatables/responsive.bootstrap4.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable').DataTable();

        //Buttons examples
        var table = $('#datatable-buttons').DataTable({
            lengthChange: false,
            buttons: ['csv', 'pdf']
        });

        table.buttons().container()
                .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
    } );

</script>
