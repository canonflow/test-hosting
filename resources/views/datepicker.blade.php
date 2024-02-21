<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/js/datepicker.js')
    @vite('resources/css/app.css')
    <style>
        .air-datepicker-cell.-selected- {
            background-color:  oklch(var(--p)) !important;
        }

        .air-datepicker-cell.-current- {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <input type="text" id="date" class="input input-bordered input-primary my-5 text-white rounded-md" placeholder="Enter date" readonly>
    <button class="btn btn-secondary" onclick="getValue()">Console Log</button>

    <div class="pt-10"></div>
    <div class="flex gap-x-5">
        <input type="text" id="dateMin" class="input input-bordered input-primary my-5 text-white rounded-md" placeholder="Enter date" readonly>
        <input type="text" id="dateMax" class="input input-bordered input-primary my-5 text-white rounded-md" placeholder="Enter date" readonly>
    </div>

    <div class="pt-5">
        <progress class="progress progress-error w-56" value="0" max="100" id="progress"></progress>
    </div>

    <script type="module">
        const dp = datePicker("#date");
        const { dpMin, dpMax } = minMaxDatePicker("#dateMin", "#dateMax");
        console.log({ dpMin, dpMax });
    </script>
    <script>
        const inputDP = document.getElementById('date');
        const progress = document.getElementById('progress');
        let prg = 1;
        setInterval(() => {
            progress.value = prg;
            prg++;
        }, 10);


        const getValue = () => {
            // console.log(new Date(inputDP.value).toLocaleString('en-US', { 
            //         year: 'numeric',
            //         month: 'numeric',
            //         day: 'numeric',
            //         hour: '2-digit',
            //         minute: '2-digit',
            //         hour12: false, 
            //     }
            // ));
            // console.log(new Date(inputDP.value).toLocaleString('en-US', { 
            //         dateStyle: 'short',
            //         timeStyle: 'short',
            //         hour12: false, 
            //     }
            // ));
            const dateTime = new Date("2023-10-31 05:30:44");
            const dateString = dateTime.toLocaleDateString('en-US', { 
                    year: 'numeric',
                    month: 'numeric',
                    day: 'numeric', 
                }
            );
            const timeString = dateTime.toLocaleTimeString('en-US', { timeStyle: 'short', hour12: false });

            const formattedDateTime = dateString + ' ' + timeString;  // 10/31/23 05:30
            console.log(formattedDateTime);
        };
    </script>
</body>
</html>