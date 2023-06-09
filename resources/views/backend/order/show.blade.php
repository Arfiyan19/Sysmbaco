@extends('backend.layouts.master')

@section('title','Order Detail')

@section('main-content')
<div class="card">
  <h5 class="card-header">Order detail
  </h5>
  <div class="card-body">
    <a href="{{route('cetak_invoice',$order->id)}}" class="btn btn-primary" target="_blank" style="margin-bottom: 15px;">CETAK INVOICE</a>
    @if($order)
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>S.N.</th>
          <th>Nomor Order</th>
          <th>Nama</th>
          <th>Email</th>
          <th>Jumlah</th>
          <th>Total Amount</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{$order->id}}</td>
          <td>{{$order->order_number}}</td>
          <td>{{$order->nama}}</td>
          <td>{{$order->email}}</td>
          <td>{{$order->quantity}}</td>
          <td>Rp. {{number_format($order->total_amount,2)}}</td>
          <td>
            @if($order->status=='new')
            <span class="badge badge-primary">{{$order->status}}</span>
            @elseif($order->status=='process')
            <span class="badge badge-warning">{{$order->status}}</span>
            @elseif($order->status=='delivered')
            <span class="badge badge-success">{{$order->status}}</span>
            @else
            <span class="badge badge-danger">{{$order->status}}</span>
            @endif
          </td>
          <td>
            <a href="{{route('order.edit',$order->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
            <form method="POST" action="{{route('order.destroy',[$order->id])}}">
              @csrf
              @method('delete')
              <button class="btn btn-danger btn-sm dltBtn" data-id={{$order->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
            </form>
          </td>

        </tr>
      </tbody>
    </table>

    <section class="confirmation_part section_padding">
      <div class="order_boxes">
        <div class="row">
          <div class="col-lg-6 col-lx-4">
            <div class="order-info">
              <h4 class="text-center pb-4">INFORMASI ORDER</h4>
              <table class="table">
                <tr class="">
                  <td>Nomor Order</td>
                  <td> : {{$order->order_number}}</td>
                </tr>
                <tr>
                  <td>Tanggal Order</td>
                  <td> : {{$order->created_at->format('D d M, Y')}} at {{$order->created_at->format('g : i a')}} </td>
                </tr>
                <tr>
                  <td>Jumlah</td>
                  <td> : {{$order->quantity}}</td>
                </tr>
                <tr>
                  <td>Status Order</td>
                  <td> : {{$order->status}}</td>
                </tr>

                <tr>
                  <td>Kupon</td>
                  <td> : Rp. {{number_format($order->coupon,2)}}</td>
                </tr>
                <tr>
                  <td>Total Pembelian</td>
                  <td> : Rp. {{number_format($order->sub_total,2)}}</td>
                </tr>
                <tr>
                  <td>Biaya Ongkir</td>
                  <td> : Rp. {{number_format($order->biayaOngkir,2)}}</td>
                </tr>
                <tr>
                  <td>Total</td>
                  <td> : Rp. {{number_format($order->total_amount,2)}}</td>
                </tr>
                <tr>
                  <td>Pembayaran</td>
                  <td> : Saldo Dompet </td>
                </tr>
                <tr>
                  <td>Sisa Saldo</td>
                  <td> : Rp. {{number_format($order->user->saldo,2)}} </td>
                </tr>
              </table>

            </div>
          </div>

          <div class="col-lg-6 col-lx-4">
            <div class="shipping-info">
              <h4 class="text-center pb-4">INFORMASI PEMBELI</h4>
              <table class="table">
                <tr class="">
                  <td>Nama</td>
                  <td> : {{$order->nama}}</td>
                </tr>
                <tr>
                  <td>Email</td>
                  <td> : {{$order->email}}</td>
                </tr>
                <tr>
                  <td>Nomor Handphone</td>
                  <td> : {{$order->phone}}</td>
                </tr>
                <tr>
                  <td>Alamat Lengkap</td>
                  <td> : {{$order->alamat}},&nbsp;Desa/Kelurahan {{ $subdistrict->subdistrictName }},&nbsp;Kecamatan {{ $district->districtName }}
                    , Kode Pos {{ $subdistrict->postalCode }}, Kota/Kabupaten {{$kota->cityName}}, &nbsp; {{$provinsi->provinceName}}, &nbsp; {{$order->negara}}
                  </td>
                </tr>
                <tr>
                  <td>Jasa Ekspedisi</td>
                  <td> : {{$order->ekspedisi}}</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>


    <section class="confirmation_part section_padding" style="margin-top: 20px;">
      <div class="order_boxes">
        <div class="row">
          <div class="col-lg-6 col-lx-4">
            <div class="order-info">
              <h4 class="text-center pb-4">INFORMASI PRODUK</h4>
              <table class="table">
                @foreach($cart as $cart)
                <tr class="">

                  <td>Nama Produk</td>
                  <td>: {{$cart->product->title}}</td>
                </tr>
                <tr class="">
                  <td>Jumlah Pembelian </td>
                  <td>: {{$cart->quantity}}</td>
                </tr>
                <tr class="">
                  <td>Total Pembelian </td>
                  <td>: Rp. {{number_format($cart->amount,2) }}</td>
                </tr>
                @endforeach
                <tr>
                  <td>Total Keseluruhan</td>
                  <td> : Rp. {{number_format($order->total_amount,2)}}</td>
                </tr>
              </table>
            </div>
          </div>

        </div>
      </div>
    </section>

    @endif


  </div>
</div>
@endsection

@push('styles')
<style>
  .order-info,
  .shipping-info {
    background: #ECECEC;
    padding: 20px;
  }

  .order-info h4,
  .shipping-info h4 {
    text-decoration: underline;
  }
</style>
@endpush