
<?php
include 'connection.php';
            $query = "
                SELECT DATE_FORMAT(ad_date, '%b') AS month, COUNT(*) AS count
                FROM addopt_pet
                GROUP BY MONTH(ad_date)
                ORDER BY MONTH(ad_date)
            ";

            $result = mysqli_query($cnn, $query);

            $monthCounts = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $monthCounts[$row['month']] = $row['count'];
            }

            // Prepare full month list
            $allMonths = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            $labels = [];
            $data = [];

            foreach ($allMonths as $month) {
                $labels[] = $month;
                $data[] = isset($monthCounts[$month]) ? $monthCounts[$month] : 0;
            }
            ?>
    <script>
       const ctx = document.getElementById('adoptionChart').getContext('2d');
              const adoptionChart = new Chart(ctx, {
                type: 'line',
                data: {
                  labels: <?php echo json_encode($labels); ?>,
                  datasets: [{
                    label: 'Adoptions per Month',
                    data: <?php echo json_encode($data); ?>,
                    backgroundColor: '#eadfd7',
                    borderColor: '#976239',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true,
                    pointRadius: 4,
                    pointHoverRadius: 6
                  }]
                },
                options: {
                  responsive: true,
                  layout: {
                      padding: {
                        left: 0 // 👈 Removes extra left padding
                      }
                    },
                  plugins: {
                    legend: {
                      position: 'top',
                      labels: {
                        color: '#976239'
                      }
                    },
                    title: {
                      display: true,
                      // text: 'Adoption Rate by Month',
                      color: '#976239',
                      font: {
                        size: 16
                      }
                    }
                  },
                  scales: {
                    y: {
                      beginAtZero: true,
                      max:<?php echo max($data); ?> + 100,
                      ticks: {
                        stepSize: 10 ,
                        color: '#333',
                        // padding: 4 // 👈 Reduce space between ticks and chart
                      }
                    },
                    x: {
                      ticks: {
                        color: '#333'
                      }
                    }
                  }
                }
              });

      </script>