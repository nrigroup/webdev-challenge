@extends('layouts.app')
@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">CSV Import</div>
                    <div class="panel-body">
                        Data imported successfully.
                    </div>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                       Parsed Data
                    </h2>
                     <div class="overflow-hidden overflow-x-auto min-w-full align-middle sm:rounded-md">
                        <table class="min-w-full divide-y divide-gray-200 border">
                            <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50">
                                    <span class="text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Date</span>
                                </th>
                                <th class="px-6 py-3 bg-gray-50">
                                    <span class="text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Category</span>
                                </th>
                                <th class="px-6 py-3 bg-gray-50">
                                    <span class="text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Lot_title</span>
                                </th>
                                <th class="px-6 py-3 bg-gray-50">
                                    <span class="text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Lot_location</span>
                                </th>
                                <th class="px-6 py-3 bg-gray-50">
                                    <span class="text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">lot_condition</span>
                                </th>
                                <th class="px-6 py-3 bg-gray-50">
                                    <span class="text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Pre_tax_amount</span>
                                </th>
                                <th class="px-6 py-3 bg-gray-50">
                                    <span class="text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Tax_amount</span>
                                </th>
                            </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                            @foreach($dataInfos as $dataInfo)
                                <tr class="bg-white">
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{ $dataInfo->date}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{ $dataInfo->category }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{ $dataInfo->lot_title }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{ $dataInfo->lot_location }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{ $dataInfo->lot_condition }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{ $dataInfo->pre_tax_amount }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{ $dataInfo->tax_amount }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
