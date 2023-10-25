<script>
<?php
$kejahatan = "";
$total = "";
$warna = "";
$i = 1;
$c = count($show_kejahatan);
foreach($show_kejahatan as $row):
    if ($i < $c) {
        $kejahatan .= "'".$row['kejahatan']."'".",";  
        $warna .= "'".$row['warna']."'".",";
        $total .= "'".$row['total']."'".",";
    } else {
        $kejahatan .= "'".$row['kejahatan']."'";
        $warna .= "'".$row['warna']."'";
        $total .= "'".$row['total']."'";
    }
     $i++;
endforeach;

$query = $this->db->select("MAX(jumlah_kejahatan) as total")->from("tb_data_kejahatan")->get()->row_array();
$max = $query['total'];
?>
const c_tanah = document.getElementById('kejahatan');
const myCtanah = new Chart(c_tanah, {
    type: 'bar',
    data: {
        labels: [<?= $kejahatan ?>],
        datasets: [{
            label: 'Kejahatan',
            data: [<?= $total ?>],
            backgroundColor: [
                <?= $warna ?>
            ],
            hoverOffset: 4,
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        labels: {
            render: 'label'
        },
        scales: {
            yAxes: [{
                ticks: {
                    stepSize: 10,
                    beginAtZero: true
                }
            }]
        },
    }
});
</script>