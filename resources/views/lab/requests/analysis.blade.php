@extends('lab.layouts.index')
@section('title')
    {{ __('Analysis') }}
@endsection
@section('content')
    @livewire('analysis', ['invoice_item' => $invoice_item])
@endsection

@push('css')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        section {
            text-align: center;
            padding: 0 50px;
        }


        .main-head {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            margin-top: 30px;
            gap: 20px;
        }

        .main-head h1.ar {
            font-size: 33px;
            font-weight: normal;
        }

        .main-head h1 span {
            font-weight: bold;
        }

        .main-head img {
            width: 64px;
        }

        table {
            margin: auto;
            width: 100%;
            font-size: 14px;
            border: 1px solid black !important;
        }

        .qr-table-holder>svg {
            width: 100px;
            height: 100px;
        }

        @media (min-width: 200px) and (max-width: 576px) {

            table tr td,
            table tr th {
                padding: 4px 3px !important;
            }

            table {
                font-size: 6px !important;
            }

            .qr-table-holder>svg {
                width: 50px;
                height: 50px;
            }

            section {
                padding: 0px 5px;
            }

            .main-head {
                margin-bottom: 10px;
            }

            .main-head h1.ar {
                font-size: 21px;
            }

            .height {
                height: 30px !important;
            }
        }

        @media (min-width: 576px) and (max-width: 768px) {
            table {
                font-size: 8px !important;
            }

            .main-head {
                margin-bottom: 10px;
            }

            .qr-table-holder>svg {
                width: 75px;
                height: 75px;
            }
        }

        @media (min-width: 768px) and (max-width: 992px) {
            table {
                font-size: 10px !important;
            }
        }

        @media (min-width: 992px) and (max-width: 1200px) {
            table {
                font-size: 11px !important;
            }
        }

        @media (min-width: 1200px) and (max-width: 1400px) {
            table {
                font-size: 12px !important;
            }
        }

        table tr td,
        table tr th {
            padding: 5px 5px;
            position: relative;
        }

        table tr td .rig {
            float: right;
        }

        table tr td .lef {
            float: left;
            margin-right: 5px;
        }

        table tr td .cen {
            position: absolute;
            /* left: 50%; */
            left: 40%;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        table,
        th,
        td {
            border: 1px solid black !important;
            border-collapse: collapse;
        }

        table tr td.hidd-1 {
            border-left-color: transparent;
        }

        table tr td.hidd-2 {
            border-left-color: transparent;
        }

        .text {
            display: flex;
            justify-content: space-evenly;
            margin-top: 10px;
        }

        .print {
            text-decoration: none;
            color: white;
            background-color: #2fc2df;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            margin: 20px auto 0;
            display: block;
            width: fit-content;
        }

        @media print {
            .main-section {
                background-color: #fff;
            }

            section {
                padding: 0px !important;
                /* background-color: #fff; */
                /* height: 100vh; */
            }


            table {
                width: 100%;
                font-size: 9px !important;
            }

            table tr td div {
                display: flex;
                float: unset;
                justify-content: space-between;
            }

            section {
                padding: 0;
            }

            body {
                font-size: 5px;
            }

            table tr td .pir-r {
                margin-left: 25px;
            }

            table tr td .pir-l {
                margin-right: 25px;
            }

            .print {
                display: none;
            }

            table,
            th,
            td {
                padding: 3px !important;
                border: 1px solid black !important;
                border-collapse: collapse;
            }

            table tr td .cen {
                left: 32% !important;
            }

            table tr td .cen.one {
                left: 40% !important;
            }

            .qr-table-holder {
                width: 100%;
                text-align: center;
                margin-right: 15px !important;
            }

            .qr-table-holder>svg {
                width: 85px;
                height: 85px;
            }
        }
    </style>
@endpush
