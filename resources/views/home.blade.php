<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Hệ thống quản lý giảng đường</title>
    <link href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/plugins/datatables/css/jquery.datatables.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/plugins/datatables/css/jquery.datatables_themeroller.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/plugins/x-editable/bootstrap3-editable/css/bootstrap-editable.css')}}" rel="stylesheet"/>
</head>

<body>
    <div class="navbar navbar-default navbar-static-top" role="navigation">
        <div class="container">
            <div class="navbar-header"><button class="navbar-toggle" data-target=".navbar-collapse"
                    data-toggle="collapse" type="button"><span class="sr-only">Toggle navigation</span><span
                        class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a
                    class="navbar-brand" href="/">QLGD</a></div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="/huongdan.htm">Hướng dẫn sử dụng</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/users/sign_in">Đăng nhập</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container">
        <form action="/search" class="form-horizontal" method="GET" role="form">
            <div class="form-group">
                <div class="col-sm-2">
                    <select name="mtype" id="mtype" class="form-control">
                        <option value='1'>Sinh viên</option>
                        <option value='2'>Lớp môn học</option>
                        <option value='3'>Lịch trình</option>
                    </select>
                </div>
                <div class="col-sm-6"><input class="form-control" name="query" placeholder="Thông tin tra cứu"
                        type="text" value="" /></div>
                <button class="btn btn-primary btn-default" type="submit">Tra cứu</button>
            </div>
        </form>
        <h4>Lịch học trong ngày</h4>
        <div>
            <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                <thead style="color: #fff;background-color: #343a40;border-color: #454d55;">
                    <tr>
                        <td>Thời gian</td>
                        <td>Số tiết</td>
                        <td>Phòng</td>
                        <td>Giảng viên</td>
                        <td>Mã lớp</td>
                        <td>Môn</td>
                        <td>Sĩ số </td>
                        <td>Nội dung</td>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table-success">
                        <td><a href="/tenants/1/lich/827">07h00 11/10/2021</a></td>
                        <td style="text-align: center;">2</td>
                        <td><a href="/search?mtype=3&amp;query=C101">C101</a><br />Lý thuyết</td>
                        <td>Nguyễn Thị Hà Anh</td>
                        <td><a href="/tenants/1/lop/52">NA24</a></td>
                        <td><a href="http://decuong.hpu.edu.vn/show/LIN31021">Dẫn Luận Ngôn Ngữ</a></td>
                        <td style="text-align: center;">20/20</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><a href="/tenants/1/lich/619">15h50 11/10/2021</a></td>
                        <td style="text-align: center;">2</td>
                        <td><a href="/search?mtype=3&amp;query=C101">C101</a><br />Lý thuyết</td>
                        <td>Lê Thị Như Trang</td>
                        <td><a href="/tenants/1/lop/39">NA2301N</a></td>
                        <td><a href="http://decuong.hpu.edu.vn/show/JPL32023">Từ Vựng Tiếng Nhật 3</a></td>
                        <td style="text-align: center;">6/6</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><a href="/tenants/1/lich/241">15h50 11/10/2021</a></td>
                        <td style="text-align: center;">2</td>
                        <td><a href="/search?mtype=3&amp;query=C301">C301*</a><br />Lý thuyết</td>
                        <td>Đặng Quang Huy</td>
                        <td><a href="/tenants/1/lop/14">CT23</a></td>
                        <td><a href="http://decuong.hpu.edu.vn/show/CGR33031">Đồ Hoạ Máy Tính</a></td>
                        <td style="text-align: center;">17/17</td>
                        <td>Chương 4: Đồ họa 3D.
                            ...
                        </td>
                    </tr>
                    <tr>
                        <td><a href="/tenants/1/lich/1673">15h50 11/10/2021</a></td>
                        <td style="text-align: center;">2</td>
                        <td><a href="/search?mtype=3&amp;query=C304">C304</a><br />Lý thuyết</td>
                        <td>Bùi Thị Mai Anh</td>
                        <td><a href="/tenants/1/lop/305">NA25</a></td>
                        <td><a href="http://decuong.hpu.edu.vn/show/WRI32031">Viết 1</a></td>
                        <td style="text-align: center;">37/37</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><a href="/tenants/1/lich/1753">15h50 11/10/2021</a></td>
                        <td style="text-align: center;">2</td>
                        <td><a href="/search?mtype=3&amp;query=D201">D201</a><br />Lý thuyết</td>
                        <td>Hoàng Hải Vân</td>
                        <td><a href="/tenants/1/lop/310">CT-DC25</a></td>
                        <td><a href="http://decuong.hpu.edu.vn/show/MAT31031">Toán Cao Cấp 1</a></td>
                        <td style="text-align: center;">73/73</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><a href="/tenants/1/lich/1833">15h50 11/10/2021</a></td>
                        <td style="text-align: center;">2</td>
                        <td><a href="/search?mtype=3&amp;query=D301">D301</a><br />Lý thuyết</td>
                        <td>Nguyễn Bá Hùng</td>
                        <td><a href="/tenants/1/lop/315">DL-QT25</a></td>
                        <td><a href="http://decuong.hpu.edu.vn/show/PHI31031">Triết Học</a></td>
                        <td style="text-align: center;">56/56</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div id="footer">
        <div class="container">
            <p>Đại học Sư phạm Hà Nội - Học kỳ 1, năm học 2021-2022</p>
        </div>
    </div>
</body>

<script src="{{asset('assets/plugins/jquery/jquery-2.1.4.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-blockui/jquery.blockui.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('assets/plugins/waves/waves.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-mockjax-master/jquery.mockjax.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/js/jquery.datatables.min.js')}}"></script>
<script src="{{asset('assets/plugins/x-editable/bootstrap3-editable/js/bootstrap-editable.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('assets/js/pages/table-data.js')}}"></script>

</html>