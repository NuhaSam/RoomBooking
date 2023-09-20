@include('../layouts/header')


    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>Halls</h2>
                        <div class="bt-option">

                            <span>room & workspace</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach($halls as $hall)
    <section class="rooms-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-8">
                    <div class="room-item">
                        <div class="ri-text">
                            <h4>{{$hall->name}}</h4>
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="r-o">Type:</td>
                                        <td>{{$hall->type}}</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Number of seats:</td>
                                        <td>{{ $hall->number_of_seats}}</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">location:</td>
                                        <td>{{$hall->location}}</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">days:</td>
                                        <td>{{$hall->days_of_works}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <form action="{{ route('appointment',$hall->id) }}" method="get">
                                <button type="submit" class="btn btn-info">
                                    <a class="primary-btn">Appointment</a>
                                </button>
                            </form>
                            <form action="{{ route('hall.edit',$hall->id) }}" method="get">
                                @csrf
                                <button type="submit" class="btn btn-info">
                                    <a class="primary-btn">Edit</a>
                                </button>
                            </form>
                            <form action="{{ route('hall.destroy',$hall->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-info">
                                    <a class="primary-btn">Delete</a>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>


                @endforeach
                <div class="col-lg-12">
                    {{ $halls->links()}}
                </div>
            </div>
        </div>
    </section>
    <!-- Rooms Section End -->
@include('../layouts/footer')