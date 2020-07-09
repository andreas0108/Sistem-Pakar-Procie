<script>
    $(document).ready(function() {
        $('#table-statistik').DataTable({
            "ordering": false,
            "autoWidth": false
        });

        var multipleLineChart = document.getElementById('stats-komponen').getContext('2d');

        var myMultipleLineChart = new Chart(multipleLineChart, {
            type: 'line',
            data: {
                labels: [<?= $label ?>],
                datasets: [{
                    label: "Intel",
                    borderColor: "#1d7af3",
                    pointBorderColor: "#FFF",
                    pointBackgroundColor: "#1d7af3",
                    pointBorderWidth: 2,
                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 1,
                    pointRadius: 4,
                    backgroundColor: 'transparent',
                    fill: true,
                    borderWidth: 2,
                    data: [<?= $intel['stats'] ?>]
                }, {
                    label: "AMD",
                    borderColor: "#f3545d",
                    pointBorderColor: "#FFF",
                    pointBackgroundColor: "#f3545d",
                    pointBorderWidth: 2,
                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 1,
                    pointRadius: 4,
                    backgroundColor: 'transparent',
                    fill: true,
                    borderWidth: 2,
                    data: [<?= $amd['stats'] ?>]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'top',
                },
                tooltips: {
                    bodySpacing: 4,
                    mode: "nearest",
                    intersect: 0,
                    position: "nearest",
                    xPadding: 10,
                    yPadding: 10,
                    caretPadding: 10
                },
                layout: {
                    padding: {
                        left: 15,
                        right: 15,
                        top: 15,
                        bottom: 15
                    }
                }
            }
        });
    });
</script>