<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sudoku Solver</title>

        <!-- Links -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <!-- Scripts -->
        <script src="/app.js"></script>

        <!-- Styles -->
        <style>
            body {
                background-image: url('sudoku.jpg');
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: cover;
            }

            button {
                border-radius: 8px;
                color: black;
                padding: 10px 24px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                transition-duration: 0.4s;
                cursor: pointer;
                box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
            }

            table { 
                border-collapse: collapse; 
                font-family: Calibri, sans-serif; 
            }

            colgroup, tbody { 
                border: solid medium; 
            }

            td { 
                border: solid thin; 
                height: 2.0em; 
                width: 2.0em;
                padding: 0;
                background-color: whitesmoke;   
            }

            input { 
                outline: none; 
                text-align: center;
                width: 1.5em;
                border: none;
                background-color: whitesmoke; 
            }

            div {
                text-align: center;
            }

            p {
                text-align: start;
            }
        </style>        
    </head>
    <body>
        <h1 class="text-center pt-5 pb-3"><b>SUDOKU SOLVER</b></h1>
        <div class="container py-3">
            @isset($error)
                <h3 class="text-danger text-left">{{ $error }}</h3>
            @endisset
            <div class="row">
                <div class="col-md py-3">                    
                    <form action="{{ route('submit') }}" method="get">
                        @csrf
                        <table>
                            <caption>Enter some numbers to the board and click submit.</caption>
                            <colgroup><col><col><col></colgroup>
                            <colgroup><col><col><col></colgroup>
                            <colgroup><col><col><col></colgroup>   
                            <tbody>
                            @for ($i = 0; $i < 9; $i++)
                                @if ($i % 3 == 0)
                                    <!--<tbody>-->
                                    <tr style="border-top: solid medium">
                                @else
                                <tr>
                                @endif
                                @for ($j = 0; $j < 9; $j++)
                                    <td>
                                        <input type="hidden" name="x-pos" value="{{ $i }}">
                                        <input type="hidden" name="y-pos" value="{{ $j }}">
                                        <input type="text" name="num[{{ $i }}][{{ $j }}]" maxlength="1" size="1" autocomplete="off" value="{{ $board[$i][$j] }}">
                                @endfor
                            @endfor
                        </table>
                        <button type="submit">Submit</button><br>
                        <span class="text-danger">@error('num.*') {{ "Each entry must be an integer between 1 and 9, included." }} @enderror</span>
                    </form>
                    <button onclick="window.location.href = '../';">Restart</button><br>
                </div>
                <div class="col-md py-3">
                    @isset ($solution)
                        @if ($solution)
                            <table>    
                                <caption>Solution</caption>
                                <colgroup><col><col><col></colgroup>
                                <colgroup><col><col><col></colgroup>
                                <colgroup><col><col><col></colgroup>
                                <tbody>
                                @for ($i = 0; $i < 9; $i++)
                                    @if ($i % 3 == 0)
                                        <tbody> 
                                    @endif
                                    <tr> 
                                    @for ($j = 0; $j < 9; $j++)
                                        <td>
                                            <div> {{ $solution[$i][$j] }} </div>
                                    @endfor
                                @endfor
                            </table>
                        @endif
                    @endisset 
                </div>
            </div>
        </div>
    </body>
</html>