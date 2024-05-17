<div id="preloader" class="bg-theme-secondary-light">
    <center>
        <div class="loader"></div>
    </center>
    <style>
        /* HTML: <div class="loader"></div> */
        .loader {
            margin-top: 10%;
            width: 150px;
            aspect-ratio: 1;
            display: grid;
            border: 4px solid #0000;
            border-radius: 50%;
            border-right-color: #25b09b;
            animation: l15 1s infinite linear;
        }
        .loader::before,
        .loader::after {
            content: "";
            grid-area: 1/1;
            margin: 2px;
            border: inherit;
            border-radius: 50%;
            animation: l15 2s infinite;
        }
        .loader::after {
            margin: 8px;
            animation-duration: 3s;
        }
        @keyframes l15{
            100%{transform: rotate(1turn)}
        }
    </style>
</div>