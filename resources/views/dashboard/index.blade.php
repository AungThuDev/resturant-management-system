@extends('layouts.master')
@section('header','Dashboard')
@section('dash-active','active')
@section('content')
    <div class="row">
        <div class="col-lg-3">
            <canvas id="myChart" width="400" height="400"></canvas>
        </div> 
    </div>
@endsection
@section('script')
<script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Users', 'Categories', 'Recipes', 'Kitchens'],
                datasets: [{
                    label: '# of Items',
                    data: [
                        {{ $userData }},
                        {{ $categoryData }},
                        {{ $recipeData }},
                        {{ $kitchenData }}
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(75, 192, 192, 0.5)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                // Add options here if needed
            }
        });
    </script>
@endsection