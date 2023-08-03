<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
error_reporting(0);
use App\ProductCat;
use App\Brand;
use App\JenisProduk;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $product = Product::all();

      return view('admin.product.index', [
        'folder' => 'pengaturanproduk',
        'menu' => 'product',
        'product' => $product
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productcat = ProductCat::all();
        $brand = Brand::all();
        $jenisproduk = JenisProduk::all();

        return view('admin.product.create', [
          'folder' => 'pengaturanproduk',
          'menu' => 'product',
          'productcat' => $productcat,
          'brand' => $brand,
          'jenisproduk' => $jenisproduk
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        //$post = Post::create($request->all());
      //  $product = Product::all();
        $this->validate($request,[
          'nama' => 'required',
          'kategori' => 'required',
          'brand' => 'required',
          'jenisproduk' => 'required',
          'berat' => 'required',
          'stok' => 'required',
          'harga' => 'required',
          // 'harga_coret' => 'required',
          'deskripsi1' => 'required',
          //'deskripsi2' => 'required',
          'gambar1' => 'required|image|mimes:jpg,png,jpeg,gif|max:2048',
          'gambar2' => 'image|mimes:jpg,png,jpeg,gif|max:2048',
          'gambar3' => 'image|mimes:jpg,png,jpeg,gif|max:2048',
          'gambar4' => 'image|mimes:jpg,png,jpeg,gif|max:2048',
          // 'gambar5' => 'image|mimes:jpg,png,jpeg,gif|max:2048',
          // 'meta_title' => 'required',
          // 'meta_deskripsi' => 'required',
          // 'meta_keyword' => 'required',
        ]);

        $last = Product::orderBy('id','desc')->first();
        if($last){
          $lastdigit = '2';
        }else{
          $lastdigit = '1';
        }

        $random = mt_rand(1000,9999);
        $kode_produk = "SKU".$random;

        $gambar1 = $request->gambar1;
        if($gambar1){
          $new_gambar1 = time().$gambar1->getClientOriginalName();
          // $gambar1->move('public/assets/product/', $new_gambar1);
          $gambar1->move('assets/product/', $new_gambar1);
        }else{
          $new_gambar1 = "";
        }

        $gambar2 = $request->gambar2;
        if($gambar2){
          $new_gambar2 = time().$gambar2->getClientOriginalName();
          // $gambar2->move('public/assets/product/', $new_gambar2);
          $gambar2->move('assets/product/', $new_gambar2);
        }else{
          $new_gambar2 = "";
        }

        $gambar3 = $request->gambar3;
        if($gambar3){
          $new_gambar3 = time().$gambar3->getClientOriginalName();
          // $gambar3->move('public/assets/product/', $new_gambar3);
          $gambar3->move('assets/product/', $new_gambar3);
        }else{
          $new_gambar3 = "";
        }

        $gambar4 = $request->gambar4;
        if($gambar4){
          $new_gambar4 = time().$gambar4->getClientOriginalName();
          // $gambar4->move('public/assets/product/', $new_gambar4);
          $gambar4->move('assets/product/', $new_gambar4);
        }else{
          $new_gambar4 = "";
        }

        // $gambar5 = $request->gambar5;
        // if($gambar5){
        //   $new_gambar5 = time().$gambar5->getClientOriginalName();
        //   $gambar5->move('public/assets/product/', $new_gambar5);
        // }else{
        //   $new_gambar5 = "";
        // }


        $product = Product::create([
          'kode_produk' => $kode_produk,
          'nama' => $request->nama,
          'kategoriproduk_id' => $request->kategori,
          'brand' => $request->brand,
          'jenisproduk' => $request->jenisproduk,
          'berat' => $request->berat,
          'stok' => $request->stok,
          'harga' => $request->harga,
          //'harga_coret' => $request->harga_coret,
          'deskripsi1' => $request->deskripsi1,
          'deskripsi2' => $request->deskripsi2,
          'gambar1' => $new_gambar1,
          'gambar2' => $new_gambar2,
          'gambar3' => $new_gambar3,
          'gambar4' => $new_gambar4,
          // 'gambar5' => $new_gambar5,
          'meta_title' => $request->meta_title,
          'meta_deskripsi' => $request->meta_deskripsi,
          'meta_keyword' => $request->meta_keyword,
          'slug' => Str::slug($request->nama)
        ]);

        return redirect()->route('product.index')->with('success','Produk berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $productcat = ProductCat::all();
      $brand = Brand::all();
      $jenisproduk = JenisProduk::all();
      $product = Product::findorfail($id);

      return view('admin.product.edit', [
        'folder' => 'pengaturanproduk',
        'menu' => 'product',
        'product' => $product,
        'productcat' => $productcat,
        'brand' => $brand,
        'jenisproduk' => $jenisproduk
      ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate($request,[
        'nama' => 'required',
        'kategori' => 'required',
        'brand' => 'required',
        'jenisproduk' => 'required',
        'berat' => 'required',
        'stok' => 'required',
        'harga' => 'required',
        // 'harga_coret' => 'required',
        'deskripsi1' => 'required',
        //'deskripsi2' => 'required',
        'gambar1' => 'image|mimes:jpg,png,jpeg,gif|max:2048',
        'gambar2' => 'image|mimes:jpg,png,jpeg,gif|max:2048',
        'gambar3' => 'image|mimes:jpg,png,jpeg,gif|max:2048',
        'gambar4' => 'image|mimes:jpg,png,jpeg,gif|max:2048',
        // 'gambar5' => 'image|mimes:jpg,png,jpeg,gif|max:2048',
        // 'meta_title' => 'required',
        // 'meta_deskripsi' => 'required',
        // 'meta_keyword' => 'required',
      ]);

      //$product = Produk::findorfail($id);

      if($request->has('gambar1')){
        $gambar1 = $request->gambar1;
        $new_gambar1 = time().$gambar1->getClientOriginalName();
        // $gambar1->move('public/assets/product/', $new_gambar1);
        $gambar1->move('assets/product/', $new_gambar1);
      }else{
        $new_gambar1 = $request->gambar_lama1;
      }

      if($request->has('gambar2')){
        $gambar2 = $request->gambar2;
        $new_gambar2 = time().$gambar2->getClientOriginalName();
        // $gambar2->move('public/assets/product/', $new_gambar2);
        $gambar2->move('assets/product/', $new_gambar2);
      }else{
        $new_gambar2 = $request->gambar_lama2;
      }

      if($request->has('gambar3')){
        $gambar3 = $request->gambar3;
        $new_gambar3 = time().$gambar3->getClientOriginalName();
        // $gambar3->move('public/assets/product/', $new_gambar3);
        $gambar3->move('assets/product/', $new_gambar3);
      }else{
        $new_gambar3 = $request->gambar_lama3;
      }

      if($request->has('gambar4')){
        $gambar4 = $request->gambar4;
        $new_gambar4 = time().$gambar4->getClientOriginalName();
        // $gambar4->move('public/assets/product/', $new_gambar4);
        $gambar4->move('assets/product/', $new_gambar4);
      }else{
        $new_gambar4 = $request->gambar_lama4;
      }

      // if($request->has('gambar5')){
      //   $gambar5 = $request->gambar5;
      //   $new_gambar5 = time().$gambar5->getClientOriginalName();
      //   $gambar5->move('public/assets/product/', $new_gambar5);
      // }else{
      //   $new_gambar5 = $request->gambar_lama5;
      // }

      $product_data = [
        'nama' => $request->nama,
        'kategoriproduk_id' => $request->kategori,
        'brand' => $request->brand,
        'jenisproduk' => $request->jenisproduk,
        'berat' => $request->berat,
        'stok' => $request->stok,
        'harga' => $request->harga,
        //'harga_coret' => $request->harga_coret,
        'deskripsi1' => $request->deskripsi1,
        'deskripsi2' => $request->deskripsi2,
        'gambar1' => $new_gambar1,
        'gambar2' => $new_gambar2,
        'gambar3' => $new_gambar3,
        'gambar4' => $new_gambar4,
        // 'gambar5' => $new_gambar5,
        'meta_title' => $request->meta_title,
        'meta_deskripsi' => $request->meta_deskripsi,
        'meta_keyword' => $request->meta_keyword,
        'slug' => Str::slug($request->nama)
      ];

      Product::whereId($id)->update($product_data);
      return redirect()->route('product.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $product = Product::findorfail($id);
      $product->delete();

      return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
