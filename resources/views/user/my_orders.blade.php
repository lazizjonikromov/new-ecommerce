<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="" style="padding: 100px;" align="center">
                        <table>
                            <tr style="background-color: black;">
                                <td style="padding: 10px; font-size: 20px; color: white;">Name</td>
                                <td style="padding: 10px; font-size: 20px; color: white;">Quantity</td>
                                <td style="padding: 10px; font-size: 20px; color: white;">Price</td>
                                <td style="padding: 10px; font-size: 20px; color: white;">Total Price</td>
                                <td style="padding: 10px; font-size: 20px; color: white;">Status</td>
                            </tr>
                                @if ($order->count() > 0 )
                                <h1 style="font-size: 30px;">My Orders</h1>
                                <br>
                                @foreach ($order as $orders)
                                    <tr style="background-color: black;">
                                        <td style="padding: 10px; color: white;">
                                            {{$orders->product_name}}
                                        </td>
                                        <td style="padding: 10px; color: white;">
                                            {{$orders->quantity}}
                                        </td>
                                        <td style="padding: 10px; color: white;">
                                            {{$orders->price}}
                                        </td>
                                        <td style="padding: 10px; color: white;">
                                            {{$orders->totalprice}}
                                        </td>
                                        <td style="padding: 10px; color: white;">
                                            {{$orders->status}}
                                        </td>
                                    </tr>
                                @endforeach
                        </table>    
                                <br>
                                <button class="btn btn-success"><a href="{{url('/')}}" style="text-decoration: none;">← Continue Shop</a></button>
                                @else
                                    <h1 style="font-size:30px;">No Orders</h1>
                                    <br>
                                    <button class="btn btn-success"><a href="{{url('/')}}" style="text-decoration: none;">← Shop</a></button>
                                @endif
                                
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
