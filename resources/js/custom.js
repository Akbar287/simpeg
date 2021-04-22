/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

const { default: Swal } = require("sweetalert2");

if (document.location.pathname == '/home') {
    $(function(){
        $.ajax({
            url: document.location.origin + '/api/home',
            method: 'get',
            dataType: 'json',
            beforeSend: function() {
                $('#occupation-chart').append("<p>Loading...</p>")
                $('#employment-chart').append("<p>Loading...</p>")
                $('#education-chart').append("<p>Loading...</p>")
                $('#work-chart').append("<p>Loading...</p>")
            },
            success: function(data) {
                if(data.chart && data.status == 'admin') {
                    google.charts.load('current', {packages: ['corechart']});
                    var occupation = [], employment=[], work_unit=[], education = [];
                    occupation.push(['Element', 'Pegawai', {role: 'style'}]);
                    data.chart.occupation.forEach(function(item, index) { occupation.push([item.occupation_group_name, item.user, '#1E94C4']);})
                    employment.push(['Element', 'Pegawai', {role: 'style'}]);
                    data.chart.employment.forEach(function(item, index) { employment.push([item.employment_name, item.user, '#1E94C4']);})
                    work_unit.push(['Element', 'Pegawai', {role: 'style'}]);
                    data.chart.work_unit.forEach(function(item, index) { work_unit.push([item.work_unit_name, item.user, '#1E94C4']);})
                    education.push(['Element', 'Pegawai', {role: 'style'}]);
                    data.chart.education.forEach(function(item, index) { education.push([item.grade, item.user, '#1E94C4']);})
                    $('#occupation-chart').children().remove()
                    google.charts.setOnLoadCallback(function() { new google.visualization.ColumnChart(document.getElementById('occupation-chart')).draw(google.visualization.arrayToDataTable(occupation), {title: "Statistik",bar: {groupWidth: "95%"},legend: {position: "none"} }); });
                    $('#work-chart').children().remove()
                    google.charts.setOnLoadCallback(function() { new google.visualization.ColumnChart(document.getElementById('work-chart')).draw(google.visualization.arrayToDataTable(work_unit), {title: "Statistik",bar: {groupWidth: "95%"},legend: {position: "none"} }); });
                    $('#education-chart').children().remove()
                    google.charts.setOnLoadCallback(function() { new google.visualization.ColumnChart(document.getElementById('education-chart')).draw(google.visualization.arrayToDataTable(education), {title: "Statistik",bar: {groupWidth: "95%"},legend: {position: "none"} }); });
                    $('#employment-chart').children().remove()
                    google.charts.setOnLoadCallback(function() { new google.visualization.ColumnChart(document.getElementById('employment-chart')).draw(google.visualization.arrayToDataTable(employment), {title: "Statistik",bar: {groupWidth: "95%"},legend: {position: "none"} }); });
                }
            },
            error: function() {
                $('#occupation-chart').children().remove()
                $('#occupation-chart').append("<p>Kesalahan...</p>")
                $('#education-chart').children().remove()
                $('#education-chart').append("<p>Kesalahan...</p>")
                $('#employment-chart').children().remove()
                $('#employment-chart').append("<p>Kesalahan...</p>")
                $('#work-chart').children().remove()
                $('#work-chart').append("<p>Kesalahan...</p>")
            }
        })
    })
}

if(document.location.pathname == '/golongan') {
    $(function() {
        let lastNumber = parseInt($('tbody').children('tr').last().children('td.no').data('no'));
        $(".add-occ").fireModal({
            title: 'Buat Data Golongan',
            body: $("#modal-create-occ"),
            footerClass: 'bg-whitesmoke',
            autoFocus: false,
            onFormSubmit: function(modal, e, form) {

                if($('.input-create-occ').val() == ""){
                    form.stopProgress();
                    modal.find('.modal-body').children('.alert').remove()
                    modal.find('.modal-body').prepend('<div class="alert alert-danger">Masukkan Nama Golongan!</div>')
                } else if( $('.input-create-occ').val().length > 32) {
                    form.stopProgress();
                    modal.find('.modal-body').children('.alert').remove()
                    modal.find('.modal-body').prepend('<div class="alert alert-danger">Nama Golongan wajib kurang dari 32 Karakter!</div>')
                } else {
                    $.ajax({
                        url : document.location.origin + '/api'  + document.location.pathname,
                        type: 'post',
                        data: {
                            '_token': $('meta[name="csrf-token"]').attr('content'),
                            'occupation_group_name':  $('.input-create-occ').val(),
                        },
                        success: function(data) {
                            lastNumber += 1;
                            form.stopProgress();
                            modal.find('.modal-body').children('.alert').remove()
                            modal.find('.modal-body').prepend('<div class="alert alert-success">Golongan Telah dibuat</div>')
                            $('.table-stripped > tbody').append('<tr><td class="no">'+ lastNumber +'</td><td class="name">'+ data.data.occupation_group_name +'</td><td class="employee">0</td><td class="action"><button class="btn btn-danger btn-sm rounded del-occ" title="Hapus"><i class="fas fa-minus"></i></button></td></tr>')
                        }, error: function() {
                            form.stopProgress();
                            modal.find('.modal-body').children('.alert').remove()
                            modal.find('.modal-body').prepend('<div class="alert alert-danger">Mohon Cek Internet Anda.</div>')
                        }
                    })
                }
                e.preventDefault();
            },
            shown: function(modal, form) {},
            buttons: [
              {
                  text: 'Buat',
                  submit: true,
                class: 'btn btn-primary btn-shadow',
                handler: function(modal) {
                }
              }
            ]
        });
        $(document).on('click', '.del-occ', function() {
            let occupation_group_name =$(this).parent().parent().children('td.name').text();
            if($(this).parent().parent().children('td.employee').text() > 0) {
                Swal.fire(
                    'Gagal!',
                    'Anda tidak diperboleh kan menghapus Data Golongan jika masih ada pegawai.',
                    'error'
                    )
                } else {
                    Swal.fire({
                        title: 'Hapus Golongan ' + occupation_group_name + ' ?',
                    text: "Golongan yang dihapus tidak dapat dipulihkan kembali!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Hapus!',
                    cancelButtonText: 'Batalkan'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).parent().parent().remove()
                        $.ajax({
                            url : document.location.origin + '/api' + document.location.pathname,
                            type: 'delete',
                            data: {
                                '_token': $('meta[name="csrf-token"]').attr('content'),
                                'occupation_group_name':  occupation_group_name,
                                '_method': 'delete'
                            },
                            success: function() {
                                lastNumber -=1;
                                Swal.fire(
                                    'Terhapus!',
                                    'Data Golongan sudah terhapus!',
                                  'success'
                                  )
                            }, error: function() {
                                Swal.fire(
                                  'Gagal!',
                                  'Data Golongan gagal terhapus! \nTidak tersambung ke internet',
                                  'error'
                                  )
                            }
                        });
                    }
                })
            }
        })
    })
}


if(document.location.pathname == '/jabatan') {
    $(function() {
        let lastNumber = parseInt($('tbody').children('tr').last().children('td.no').data('no'));
        $(".add-emp").fireModal({
            title: 'Buat Data jabatan',
            body: $("#modal-create-emp"),
            footerClass: 'bg-whitesmoke',
            autoFocus: false,
            onFormSubmit: function(modal, e, form) {
                if($('.input-create-emp').val() == "") {
                    form.stopProgress();
                    modal.find('.modal-body').children('.alert').remove()
                    modal.find('.modal-body').prepend('<div class="alert alert-danger">Masukkan Nama Jabatan!</div>')
                } else if($('.input-create-emp').val().length > 32) {
                    form.stopProgress();
                    modal.find('.modal-body').children('.alert').remove()
                    modal.find('.modal-body').prepend('<div class="alert alert-danger">Nama Jabatan Wajib dari 32 Karakter!</div>')
                } else {
                    $.ajax({
                        url : document.location.origin + '/api' + document.location.pathname,
                        type: 'post',
                        data: {
                            '_token': $('meta[name="csrf-token"]').attr('content'),
                            'employment_name':  $('.input-create-emp').val(),
                        },
                        success: function(data) {
                            lastNumber += 1;
                            form.stopProgress();
                            modal.find('.modal-body').children('.alert').remove()
                            modal.find('.modal-body').prepend('<div class="alert alert-success">Jabatan Telah dibuat</div>')
                            $('.table-stripped > tbody').append('<tr><td class="no">'+ lastNumber +'</td><td class="name">'+ data.data.employment_name +'</td><td class="employee">0</td><td class="action"><button class="btn btn-danger btn-sm rounded del-emp" title="Hapus"><i class="fas fa-minus"></i></button></td></tr>')
                        }, error: function() {
                            form.stopProgress();
                            modal.find('.modal-body').children('.alert').remove()
                            modal.find('.modal-body').prepend('<div class="alert alert-danger">Mohon Cek Internet Anda.</div>')
                        }
                    })
                }
                e.preventDefault();
            },
            shown: function(modal, form) {},
            buttons: [
              {
                text: 'Buat',
                submit: true,
                class: 'btn btn-primary btn-shadow',
                handler: function(modal) {
                }
              }
            ]
        });
        $(document).on('click', '.del-emp', function() {
            let employment_name =$(this).parent().parent().children('td.name').text();
            if($(this).parent().parent().children('td.employee').text() > 0) {
                Swal.fire(
                    'Gagal!',
                    'Anda tidak diperboleh kan menghapus Data Jabatan jika masih ada pegawai.',
                    'error'
                  )
            } else {
                Swal.fire({
                    title: 'Hapus Jabatan ' + employment_name + ' ?',
                    text: "Jabatan yang dihapus tidak dapat dipulihkan kembali!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Hapus!',
                    cancelButtonText: 'Batalkan'
                  }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).parent().parent().remove()
                        $.ajax({
                            url : document.location.origin + '/api' + document.location.pathname,
                            type: 'delete',
                            data: {
                                '_token': $('meta[name="csrf-token"]').attr('content'),
                                'employment_name':  employment_name,
                                '_method': 'delete'
                            },
                            success: function() {
                                lastNumber -=1;
                                Swal.fire(
                                  'Terhapus!',
                                  'Data Jabatan sudah terhapus!',
                                  'success'
                                )
                            }, error: function() {
                                Swal.fire(
                                  'Gagal!',
                                  'Data Jabatan gagal terhapus! \nTidak tersambung ke internet',
                                  'error'
                                )
                            }
                        });
                    }
                  })
            }
        })
    })
}

if(document.location.pathname == '/unitkerja') {
    $(function() {
        let lastNumber = parseInt($('tbody').children('tr').last().children('td.no').data('no'));
        $(".add-wu").fireModal({
            title: 'Buat Data Unit Kerja',
            body: $("#modal-create-wu"),
            footerClass: 'bg-whitesmoke',
            autoFocus: false,
            onFormSubmit: function(modal, e, form) {
                if($('.input-create-wu').val() == "") {
                    form.stopProgress();
                    modal.find('.modal-body').children('.alert').remove()
                    modal.find('.modal-body').prepend('<div class="alert alert-danger">Masukkan Nama Unit kerja!</div>')
                } else if ($('.input-create-wu').val().length > 64) {
                    form.stopProgress();
                    modal.find('.modal-body').children('.alert').remove()
                    modal.find('.modal-body').prepend('<div class="alert alert-danger">Nama Unit kerja wajib kurang dari 64 Karakter!</div>')
                } else {
                    $.ajax({
                        url : document.location.origin + '/api' + document.location.pathname,
                        type: 'post',
                        data: {
                            '_token': $('meta[name="csrf-token"]').attr('content'),
                            'work_unit_name':  $('.input-create-wu').val(),
                        },
                        success: function(data) {
                            lastNumber += 1;
                            form.stopProgress();
                            modal.find('.modal-body').children('.alert').remove()
                            modal.find('.modal-body').prepend('<div class="alert alert-success">Unit Kerja Telah dibuat</div>')
                            $('.table-stripped > tbody').append('<tr><td class="no">'+ lastNumber +'</td><td class="name">'+ data.data.work_unit_name +'</td><td class="employee">0</td><td class="action"><button class="btn btn-danger btn-sm rounded del-wu" title="Hapus"><i class="fas fa-minus"></i></button></td></tr>')
                        }, error: function() {
                            form.stopProgress();
                            modal.find('.modal-body').children('.alert').remove()
                            modal.find('.modal-body').prepend('<div class="alert alert-danger">Mohon Cek Internet Anda.</div>')
                        }
                    })
                }
                e.preventDefault();
            },
            shown: function(modal, form) {},
            buttons: [
              {
                text: 'Buat',
                submit: true,
                class: 'btn btn-primary btn-shadow',
                handler: function(modal) {
                }
              }
            ]
        });
        $(document).on('click', '.del-wu', function() {
            let work_unit_name =$(this).parent().parent().children('td.name').text();
            if($(this).parent().parent().children('td.employee').text() > 0) {
                Swal.fire(
                    'Gagal!',
                    'Anda tidak diperboleh kan menghapus Data Unit Kerja jika masih ada pegawai.',
                    'error'
                  )
            } else {
                Swal.fire({
                    title: 'Hapus Unit Kerja ' + work_unit_name + ' ?',
                    text: "Unit Kerja yang dihapus tidak dapat dipulihkan kembali!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Hapus!',
                    cancelButtonText: 'Batalkan'
                  }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).parent().parent().remove()
                        $.ajax({
                            url : document.location.origin + '/api' + document.location.pathname,
                            type: 'delete',
                            data: {
                                '_token': $('meta[name="csrf-token"]').attr('content'),
                                'work_unit_name':  work_unit_name,
                                '_method': 'delete'
                            },
                            success: function() {
                                lastNumber -=1;
                                Swal.fire(
                                  'Terhapus!',
                                  'Data Unit Kerja sudah terhapus!',
                                  'success'
                                )
                            }, error: function() {
                                Swal.fire(
                                  'Gagal!',
                                  'Data Unit Kerja gagal terhapus! \nTidak tersambung ke internet',
                                  'error'
                                )
                            }
                        });
                    }
                  })
            }
        })
    })
}

if(document.location.pathname == '/pegawai') {
    $(function() {
        $('.table-employees').dataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
            }
        });
    })
}
if(document.location.pathname.split('/')[1] == 'cuti') {
    $(function() {
        $('.table-data').dataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
            }
        });
        $(".btn-generate-cuti").on('click', function(e) {
            e.preventDefault();

            $.ajax({
                url: document.location.origin + '/api/cuti',
                method: 'get',
                dataType: 'json',
                beforeSend: function() {
                    $(".btn-generate-cuti").parent().parent().children('input').attr('readonly')
                    $(".btn-generate-cuti").attr('disabled')
                    $(".btn-generate-cuti").siblings().attr('disabled')
                },
                success: function(data) {
                    if(data.status == 'success') {
                        $(".btn-generate-cuti").siblings().removeAttr('disabled')
                        $(".btn-generate-cuti").parent().parent().children('input').removeAttr('readonly').val(data.data)
                        $(this).removeAttr('disabled')
                    } else {}
                },
                error: function() {}
            })
        })
        $('.btn-check-cuti').on('click', function() {
            $.ajax({
                url: document.location.origin + '/api/cuti/check',
                method: 'post',
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'data': $(".btn-check-cuti").parent().parent().children('input').val()
                },
                dataType: 'json',
                beforeSend: function() {
                    $(".btn-generate-cuti").parent().parent().children('input').attr('readonly')
                    $(".btn-generate-cuti").attr('disabled')
                    $(".btn-generate-cuti").siblings().attr('disabled')
                },
                success: function(data) {
                    if(data.status == 'success') {
                        if(data.data == 0){
                            Swal.fire('No. SK', 'Nomor SK tersedia dan bisa digunakan')
                        } else  {
                            Swal.fire('No. SK', 'Nomor SK sudah digunakan')
                        }
                        $(".btn-generate-cuti").siblings().removeAttr('disabled')
                        $(this).removeAttr('disabled')
                    } else {}
                },
                error: function() {}
            })
        })

        let ket = 1;
        $('.btn-add-ketentuan').on('click', function() {
            ket = ($(this).parent().parent().parent().siblings('.col-ketentuan').children().children().length - 1)
            ket++;
            $('.form-ketentuan').append('<div class="input-group my-1 ketentuan-'+ket+'"><div class="input-group-prepend"><div class="input-group-text">'+ ket +'</div></div><input type="text" name="ketentuan[]" autocomplete="off" class="form-control"></div>');
        });
        $('.btn-remove-ketentuan').on('click', function() {
            if(ket == 1) return Swal.fire('Info', 'Ketentuan Tidak Bisa dihapus\nBiarkan saja kosong jika tidak ingin ada ketentuan', 'info')
            $(this).parent().parent().parent().siblings('.col-ketentuan').children('.form-ketentuan').children('.ketentuan-' + ket).remove()
            ket--;
        })
    })
}
if(document.location.pathname.split('/')[1] == 'laporankerja') {
    $(function() {
        $('.table-data').dataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
            }
        });
        let ket = 1;
        $('.btn-add-kegiatan').on('click', function() {
            ket = $(this).parent().parent().parent().siblings('.form-kegiatan').children().length
            ket++;
            $('.form-kegiatan').append('<div class="row"><div class="col-6 kegiatan-'+ ket +'"><div class="form-group"><label for="activities">Kegiatan/Aktivitas</label><div class="input-group my-1"><div class="input-group-prepend"><div class="input-group-text">'+ ket +'</div></div><input type="text" autocomplete="off" name="activities[]" class="form-control"></div></div></div><div class="col-4 kegiatan-'+ ket +'"><div class="form-group"><label for="result">Hasil</label><div class="input-group my-1"><div class="input-group-prepend"><div class="input-group-text">'+ ket +'</div></div><input type="text" autocomplete="off" name="result[]" class="form-control"></div></div></div><div class="col-2 kegiatan-'+ ket +'"><div class="form-group"><label for="volume">Jumlah</label><div class="input-group my-1"><div class="input-group-prepend"><div class="input-group-text">'+ ket +'</div></div><input type="text" autocomplete="off" name="volume[]" class="form-control"></div></div></div></div>');
        });
        $('.btn-remove-kegiatan').on('click', function() {
            ket = $(this).parent().parent().parent().siblings('.form-kegiatan').children().length
            if(ket == 1) return Swal.fire('Info', 'Kegiatan Tidak Bisa dihapus\nBiarkan saja kosong jika tidak ingin ada Kegiatan', 'info')

            $(this).parent().parent().parent().siblings('.form-kegiatan').children().last().remove()
            ket--;
        })
    })
}
if(document.location.pathname.split('/')[1] == 'admin') {
    $(function() {
        $('.table-data').dataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
            }
        });
        $('.btn-remove-admin').on('click', function() {
            Swal.fire({
                title: 'Batalkan Admin ?',
                text: "Admin terpilih akan dihapus hak akses admin!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Jadikan Pegawai!',
                cancelButtonText: 'Batalkan'
              }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url : document.location.origin + '/api' + document.location.pathname,
                        type: 'post',
                        data: {
                            '_token': $('meta[name="csrf-token"]').attr('content'),
                            'user_id':  $(this).data('id')
                        },
                        success: function() {
                            location.reload()
                        }, error: function() {
                            Swal.fire(
                              'Gagal!',
                              'Terjadi Kesalahan.. Cek Koneksi Internet',
                              'error'
                            )
                        }
                    });
                }
              })
        })
        $('.btn-add-admin').on('click', function() {
            Swal.fire({
                title: 'Jadikan Admin ?',
                text: "Pegawai terpilih akan dapat hak akses admin!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Jadikan Admin!',
                cancelButtonText: 'Batalkan'
              }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url : document.location.origin + '/api' + document.location.pathname,
                        type: 'post',
                        data: {
                            '_token': $('meta[name="csrf-token"]').attr('content'),
                            'user_id':  $(this).data('id')
                        },
                        success: function() {
                            location.reload()
                        }, error: function() {
                            Swal.fire(
                              'Gagal!',
                              'Terjadi Kesalahan.. Cek Koneksi Internet',
                              'error'
                            )
                        }
                    });
                }
              })
        })
        let sig = $('.kbw-signature').signature();

        $('.btn-show-sig').on('click', function() {
            $.ajax({
                url : document.location.origin + '/api/signature/',
                type: 'post',
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'employee': parseInt(location.pathname.split('/').pop())
                },
                dataType: 'json',
                success: function(data) {
                    if(data.status == 'success') {
                        sig.signature('draw', data.sig)
                        $('.btn-show-sig').parent().children('div.kbw-signature').slideToggle('slow')
                        $('.btn-show-sig').parent().children('div.btn-sig').children().children().slideToggle('slow')
                    } else {
                        $('.btn-show-sig').parent().children('p').text('Belum ada TTD').slideToggle('slow')
                    }
                }, error: function() {
                }
            })
        })

        $('.btn-save-signature').on('click', function() {
            Swal.fire({
                title: 'Ubah TTD ?',
                text: "Tanda Tangan akan diubah!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ubah!',
                cancelButtonText: 'Batalkan'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url : document.location.origin + '/api/signature',
                        type: 'post',
                        data: {
                            _method: 'put',
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            sig: $('.kbw-signature').signature('toJSON'),
                            sig_svg: sig.signature('toSVG'),
                            user_id: $(this).data('id')
                        },
                        success: function() {
                            Swal.fire(
                                'Berhasil!',
                                'Tanda Tangan berhasil diubah',
                                'success'
                            )
                        }, error: function() {
                            Swal.fire(
                              'Gagal!',
                              'Terjadi Kesalahan.. Cek Koneksi Internet',
                              'error'
                            )
                        }
                    });
                }
            })
        });
        $('#clear').on('click', function() {
            sig.signature('clear');
        })
        $('#finish_sig').on('click', function() {
            var enable = $(this).text() === 'Enable';
            $(this).text(enable ? 'Disable' : 'Enable')
            sig.signature(enable ? 'enable' : 'disable')
        })
        $('.btn-reset-pw-employee').on('click', function() {
            Swal.fire({
                title: 'Reset Password ?',
                text: "Reset Password akan dilakukan! Password akan direset ke default `123` untuk pegawai ini",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Reset!',
                cancelButtonText: 'Batalkan'
              }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url : document.location.origin + '/api/reset',
                        type: 'post',
                        data: {
                            '_token': $('meta[name="csrf-token"]').attr('content'),
                            'employee':  parseInt(location.pathname.split('/').pop())
                        },
                        success: function(data) {
                            if(data.status == 'success') {
                                Swal.fire(
                                  'Berhasil!',
                                  'Password telah direset!',
                                  'success'
                                )
                            }
                        }, error: function() {
                            Swal.fire(
                              'Gagal!',
                              'Password gagal direset',
                              'error'
                            )
                        }
                    });
                }
              })
        })
        $("#btn-change-pw").fireModal({
            title: 'Ganti Password',
            body: $("#modal-change-password"),
            footerClass: 'bg-whitesmoke',
            autoFocus: false,
            onFormSubmit: function(modal, e, form) {
                if($('.input-password').val() == "" || $('.input-password-confirm').val() == ""){
                    form.stopProgress();
                    modal.find('.modal-body').children('.alert').remove()
                    modal.find('.modal-body').prepend('<div class="alert alert-danger">Password / Konfirmasi Password harus Diisi!</div>')
                } else if($('.input-password').val() != $('.input-password-confirm').val()){
                    form.stopProgress();
                    modal.find('.modal-body').children('.alert').remove()
                    modal.find('.modal-body').prepend('<div class="alert alert-danger">Konfirmasi Password Tidak sesuai!</div>')
                }  else {
                    $.ajax({
                        url : document.location.origin + '/api'  + document.location.pathname,
                        type: 'post',
                        data: {
                            '_token': $('meta[name="csrf-token"]').attr('content'),
                            'password':  $('.input-password').val(),
                        },
                        success: async function(data) {
                            form.stopProgress();
                            modal.find('.modal-body').children('.alert').remove()
                            modal.find('.modal-body').prepend('<div class="alert alert-success">Password telah diganti</div>')
                            $('.input-password').val('')
                            $('.input-password-confirm').val('')
                        }, error: function() {
                            form.stopProgress();
                            modal.find('.modal-body').children('.alert').remove()
                            modal.find('.modal-body').prepend('<div class="alert alert-danger">Terdapat kesalahan. Cek kembali Rule Pengisian dan internet anda</div>')
                        }
                    })
                }
                e.preventDefault();
            },
            shown: function(modal, form) {},
            buttons: [
                {
                    text: 'Ganti Password',
                    submit: true,
                    class: 'btn btn-primary btn-shadow',
                    handler: function(modal) {
                    }
                }
            ]
        });
    })
}

if(document.location.pathname.split('/')[1] == 'jadwalkerja') {

    $(function() {
        $("#add-schedule").fireModal({
            title: 'Jadwalkan Kerja',
            body: $("#modal-create-schedule"),
            footerClass: 'bg-whitesmoke',
            autoFocus: false,
            onFormSubmit: function(modal, e, form) {

                if($('.input-date-sch').val() == ""){
                    form.stopProgress();
                    modal.find('.modal-body').children('.alert').remove()
                    modal.find('.modal-body').prepend('<div class="alert alert-danger">Tanggal Wajib Diisi!</div>')
                }  else {
                    $.ajax({
                        url : document.location.origin + '/api'  + document.location.pathname,
                        type: 'post',
                        data: {
                            '_token': $('meta[name="csrf-token"]').attr('content'),
                            'user_id':  $('.input-employee-sch-id').val(),
                            'date':  $('.input-date-sch').val(),
                            'jenis_kerja': $('.input-jenis_kerja-sch').val()
                        },
                        success: async function(data) {
                            form.stopProgress();
                            modal.find('.modal-body').children('.alert').remove()
                            modal.find('.modal-body').prepend('<div class="alert alert-success">Pegawai Telah Terjadwal</div>')
                            $('.input-date-sch').val('')
                            $('#calendar').fullCalendar('destroy');
                            await $("#calendar").fullCalendar({
                                defaultView: 'month',
                                height: 750,
                                businessHours: true,
                                selectable: true,
                                header: {
                                    left: 'today',
                                    center: 'title',
                                    right: 'month'
                                },
                                selectMirror: true,
                                select: function(arg) {
                                    return false;
                                },eventClick: function(arg) {
                                    if(confirm('Ingin Menghapus Jadwal Kerja Terpilih?')) {
                                        deleteSchedule(arg)
                                    }
                                },
                                dayMaxEvents: true,
                                editable: false,
                                droppable: false,
                                drop: function() {
                                },
                                events: data.schedule
                            });
                            $('#calendar').fullCalendar('render');

                        }, error: function() {
                            form.stopProgress();
                            modal.find('.modal-body').children('.alert').remove()
                            modal.find('.modal-body').prepend('<div class="alert alert-danger">Mohon Cek Internet Anda.</div>')
                        }
                    })
                }
                e.preventDefault();
            },
            shown: function(modal, form) {},
            buttons: [
                {
                    text: 'Jadwalkan',
                    submit: true,
                    class: 'btn btn-primary btn-shadow',
                    handler: function(modal) {
                    }
                }
            ]
        });

        $('.jadwal-kerja-href').on('click', async function() {
            let user = $(this).data('user');
            let name = $(this).data('name');

            $('.input-employee-sch-id').val(user)
            $('.input-employee-sch-name').val(name)

            $('.jadwal-kerja-href').removeClass('active-schedule');
            $(this).addClass('active-schedule');

            $('#title-calendar').text('Jadwal kerja ' + name);
            let data = [];
            $('.card-calendar').css('display', '')

            await $.ajax({
                url: document.location.origin + '/api/jadwalkerja/cek',
                type: 'POST',
                data: {
                  _token: $('meta[name="csrf-token"]').attr('content'),
                  user: user
                },
                beforeSend: function() {},
                success: function(res) {
                    if(res.status == true) {
                        data = res.schedule
                    }
                },
                error: function() {}
            })
            $('#calendar').fullCalendar('destroy');
            await $("#calendar").fullCalendar({
                defaultView: 'month',
                height: 750,
                businessHours: true,
                selectable: true,
                header: {
                    left: 'today',
                    center: 'title',
                    right: 'month'
                },
                selectMirror: true,
                select: function(arg) {
                    return false;
                },eventClick: function(arg) {
                    if(confirm('Ingin Menghapus Jadwal Kerja Terpilih?')) {
                        deleteSchedule(arg)
                    }
                  },
                dayMaxEvents: true,
                editable: false,
                droppable: false,
                drop: function() {
                },
                events: data
            });
            $('#calendar').fullCalendar('render');
        })
        function deleteSchedule(arg) {
            $.ajax({
                url: document.location.origin + '/api/jadwalkerja/delete',
                type: 'POST',
                data: {
                  _token: $('meta[name="csrf-token"]').attr('content'),
                  date: arg.start._i,
                  title: arg.title,
                  user_id: $('.input-employee-sch-id').val()
                },
                beforeSend: function() {},
                success: async function(res) {
                    if(res.status == true) {
                        $('#calendar').fullCalendar('destroy');
                            await $("#calendar").fullCalendar({
                                defaultView: 'month',
                                height: 750,
                                businessHours: true,
                                selectable: true,
                                header: {
                                    left: 'today',
                                    center: 'title',
                                    right: 'month'
                                },
                                selectMirror: true,
                                select: function(arg) {
                                    return false;
                                },eventClick: function(arg) {
                                    if(confirm('Ingin Menghapus Jadwal Kerja Terpilih?')) {
                                        deleteSchedule(arg)
                                    }
                                },
                                dayMaxEvents: true,
                                editable: false,
                                droppable: false,
                                drop: function() {
                                },
                                events: res.schedule
                            });
                            $('#calendar').fullCalendar('render');
                    }
                },
                error: function() {}
            })
        }
    })
}
if(document.location.pathname.split('/')[1] == 'absensi') {
    $(function() {
        $('.table-data').dataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
            }
        });
    })
}
if(document.location.pathname.split('/')[1] == 'mutation') {
    $(function() {
        $('.table-data').dataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
            }
        });
        $(".btn-generate").on('click', function(e) {
            e.preventDefault();

            $.ajax({
                url: document.location.origin + '/api/mutation',
                method: 'get',
                dataType: 'json',
                beforeSend: function() {
                    $(".btn-generate").parent().parent().children('input').attr('readonly')
                    $(".btn-generate").attr('disabled')
                    $(".btn-generate").siblings().attr('disabled')
                },
                success: function(data) {
                    if(data.status == 'success') {
                        $(".btn-generate").siblings().removeAttr('disabled')
                        $(".btn-generate").parent().parent().children('input').removeAttr('readonly').val(data.data)
                        $(this).removeAttr('disabled')
                    } else {}
                },
                error: function() {}
            })
        })
        $('.btn-check').on('click', function() {
            $.ajax({
                url: document.location.origin + '/api/mutation/check',
                method: 'post',
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'data': $(".btn-check").parent().parent().children('input').val()
                },
                dataType: 'json',
                beforeSend: function() {
                    $(".btn-generate").parent().parent().children('input').attr('readonly')
                    $(".btn-generate").attr('disabled')
                    $(".btn-generate").siblings().attr('disabled')
                },
                success: function(data) {
                    if(data.status == 'success') {
                        if(data.data == 0){
                            Swal.fire('No. SK', 'Nomor SK tersedia dan bisa digunakan')
                        } else  {
                            Swal.fire('No. SK', 'Nomor SK sudah digunakan')
                        }
                        $(".btn-generate").siblings().removeAttr('disabled')
                        $(this).removeAttr('disabled')
                    } else {}
                },
                error: function() {}
            })
        })
    })
}

if(document.location.pathname.split('/')[1] == 'pegawai') {

    $('.table-data').dataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
        }
    });
    $(".btn-generate").on('click', function(e) {
        e.preventDefault();

        $.ajax({
            url: document.location.origin + '/api/mutation',
            method: 'get',
            dataType: 'json',
            beforeSend: function() {
                $(".btn-generate").parent().parent().children('input').attr('readonly')
                $(".btn-generate").attr('disabled')
                $(".btn-generate").siblings().attr('disabled')
            },
            success: function(data) {
                if(data.status == 'success') {
                    $(".btn-generate").siblings().removeAttr('disabled')
                    $(".btn-generate").parent().parent().children('input').removeAttr('readonly').val(data.data)
                    $(this).removeAttr('disabled')
                } else {}
            },
            error: function() {}
        })
    })
    $('.btn-check').on('click', function() {
        $.ajax({
            url: document.location.origin + '/api/mutation/check',
            method: 'post',
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'data': $(".btn-check").parent().parent().children('input').val()
            },
            dataType: 'json',
            beforeSend: function() {
                $(".btn-generate").parent().parent().children('input').attr('readonly')
                $(".btn-generate").attr('disabled')
                $(".btn-generate").siblings().attr('disabled')
            },
            success: function(data) {
                if(data.status == 'success') {
                    if(data.data == 0){
                        Swal.fire('No. SK', 'Nomor SK tersedia dan bisa digunakan')
                    } else  {
                        Swal.fire('No. SK', 'Nomor SK sudah digunakan')
                    }
                    $(".btn-generate").siblings().removeAttr('disabled')
                    $(this).removeAttr('disabled')
                } else {}
            },
            error: function() {}
        })
    })
    $(".btn-generate-cuti").on('click', function(e) {
        e.preventDefault();

        $.ajax({
            url: document.location.origin + '/api/cuti',
            method: 'get',
            dataType: 'json',
            beforeSend: function() {
                $(".btn-generate-cuti").parent().parent().children('input').attr('readonly')
                $(".btn-generate-cuti").attr('disabled')
                $(".btn-generate-cuti").siblings().attr('disabled')
            },
            success: function(data) {
                if(data.status == 'success') {
                    $(".btn-generate-cuti").siblings().removeAttr('disabled')
                    $(".btn-generate-cuti").parent().parent().children('input').removeAttr('readonly').val(data.data)
                    $(this).removeAttr('disabled')
                } else {}
            },
            error: function() {}
        })
    })
    $('.btn-check-cuti').on('click', function() {
        $.ajax({
            url: document.location.origin + '/api/cuti/check',
            method: 'post',
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'data': $(".btn-check-cuti").parent().parent().children('input').val()
            },
            dataType: 'json',
            beforeSend: function() {
                $(".btn-generate-cuti").parent().parent().children('input').attr('readonly')
                $(".btn-generate-cuti").attr('disabled')
                $(".btn-generate-cuti").siblings().attr('disabled')
            },
            success: function(data) {
                if(data.status == 'success') {
                    if(data.data == 0){
                        Swal.fire('No. SK', 'Nomor SK tersedia dan bisa digunakan')
                    } else  {
                        Swal.fire('No. SK', 'Nomor SK sudah digunakan')
                    }
                    $(".btn-generate-cuti").siblings().removeAttr('disabled')
                    $(this).removeAttr('disabled')
                } else {}
            },
            error: function() {}
        })
    })

    $('.btn-reset-pw-employee').on('click', function() {
        Swal.fire({
            title: 'Reset Password ?',
            text: "Reset Password akan dilakukan! Password akan direset ke default `123` untuk pegawai ini",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Reset!',
            cancelButtonText: 'Batalkan'
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url : document.location.origin + '/api/reset',
                    type: 'post',
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'employee':  parseInt(location.pathname.split('/').pop())
                    },
                    success: function(data) {
                        if(data.status == 'success') {
                            Swal.fire(
                              'Berhasil!',
                              'Password telah direset!',
                              'success'
                            )
                        }
                    }, error: function() {
                        Swal.fire(
                          'Gagal!',
                          'Password gagal direset',
                          'error'
                        )
                    }
                });
            }
          })
    })

    let sig = $('.kbw-signature').signature();

    $('.btn-show-sig').on('click', function() {
        $.ajax({
            url : document.location.origin + '/api/signature/',
            type: 'post',
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'employee': parseInt(location.pathname.split('/').pop())
            },
            dataType: 'json',
            success: function(data) {
                if(data.status == 'success') {
                    sig.signature('draw', data.sig)
                    $('.btn-show-sig').parent().children('div.kbw-signature').slideToggle('slow')
                } else {
                    $('.btn-show-sig').parent().children('p').text('Belum ada TTD').slideToggle('slow')
                }
            }, error: function() {
            }
        })
    })

    $('#clear').on('click', function() {
        sig.signature('clear');
    })
    $('#finish_sig').on('click', function() {
        var enable = $(this).text() === 'Enable';
        $(this).text(enable ? 'Disable' : 'Enable')
        sig.signature(enable ? 'enable' : 'disable')
    })

    let ket = 1;
    $('.btn-add-ketentuan').on('click', function() {
        ket = ($(this).parent().parent().parent().siblings('.col-ketentuan').children().children().length - 1)
        ket++;
        $('.form-ketentuan').append('<div class="input-group my-1 ketentuan-'+ket+'"><div class="input-group-prepend"><div class="input-group-text">'+ ket +'</div></div><input type="text" name="ketentuan[]" autocomplete="off" class="form-control"></div>');
    });
    $('.btn-remove-ketentuan').on('click', function() {
        if(ket == 1) return Swal.fire('Info', 'Ketentuan Tidak Bisa dihapus\nBiarkan saja kosong jika tidak ingin ada ketentuan', 'info')
        $(this).parent().parent().parent().siblings('.col-ketentuan').children('.form-ketentuan').children('.ketentuan-' + ket).remove()
        ket--;
    })
}
if(document.location.pathname.split('/')[1] == 'jadwal'){
    $('.table-data').dataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
        }
    });
}
if(document.location.pathname.split('/')[1] == 'laporan'){
    $('.table-data').dataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
        }
    });
    let ket = 1;
        $('.btn-add-kegiatan').on('click', function() {
            ket = $(this).parent().parent().parent().siblings('.form-kegiatan').children().length
            ket++;
            $('.form-kegiatan').append('<div class="row"><div class="col-6 kegiatan-'+ ket +'"><div class="form-group"><label for="activities">Kegiatan/Aktivitas</label><div class="input-group my-1"><div class="input-group-prepend"><div class="input-group-text">'+ ket +'</div></div><input type="text" autocomplete="off" name="activities[]" class="form-control"></div></div></div><div class="col-4 kegiatan-'+ ket +'"><div class="form-group"><label for="result">Hasil</label><div class="input-group my-1"><div class="input-group-prepend"><div class="input-group-text">'+ ket +'</div></div><input type="text" autocomplete="off" name="result[]" class="form-control"></div></div></div><div class="col-2 kegiatan-'+ ket +'"><div class="form-group"><label for="volume">Jumlah</label><div class="input-group my-1"><div class="input-group-prepend"><div class="input-group-text">'+ ket +'</div></div><input type="text" autocomplete="off" name="volume[]" class="form-control"></div></div></div></div>');
        });
        $('.btn-remove-kegiatan').on('click', function() {
            ket = $(this).parent().parent().parent().siblings('.form-kegiatan').children().length
            if(ket == 1) return Swal.fire('Info', 'Kegiatan Tidak Bisa dihapus\nBiarkan saja kosong jika tidak ingin ada Kegiatan', 'info')

            $(this).parent().parent().parent().siblings('.form-kegiatan').children().last().remove()
            ket--;
        })
}

if(document.location.pathname.split('/')[1] == 'izinmutasi' || document.location.pathname.split('/')[1] == 'izincuti' || document.location.pathname.split('/')[1] == 'absen') {
    $('.table-data').dataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
        }
    });
    if(document.location.pathname.split('/')[2] == 'kehadiran') {
        $('input[type=file]').on('input', function() {
            $(this).parent().children('label').text(($('input[type=file]').val().split('\\')[2]))
        })
    }
    if(document.location.pathname.split('/')[2] == 'create' && $('form.wizard-content.mt-2').children('div').length == 1) {
        setInterval(function() {
            let date = new Date();
            $('#finish_work').val(twoDigitTime(date.getHours()) + ':' + twoDigitTime(date.getMinutes()))
        }, 1000);

        function twoDigitTime(time) {
            if(time < 10) {
                return '0' + time
            }
            return time
        }
    }
    if(document.location.pathname.split('/')[2] == 'create' && $('form.wizard-content.mt-2').children('div').length > 1) {
        let type_work = '',picture,loc
        let camera;
        let scanner= new Instascan.Scanner({ video: document.getElementById('webcam') });
        $('input[name=jenis_kerja]').on('input', function() {
            type_work = $('input[name=jenis_kerja]:checked').val()
            $('.btn-next-first').removeAttr('disabled')
            $('.btn-next-second').attr('disabled', '')
            $('#snapshoot').attr('src', '').css('display', 'none')
            picture = null
        })

        $('#find-me').on('click', function() {
            let dom = $(this).parent().parent().children('div')
            dom.children().remove();
            navigator.geolocation.getCurrentPosition(function(location) {
                dom.append(`<table class="table table-hover"><tbody><tr><th>Lattitude</th><td>${location.coords.latitude}</td></tr><tr><th>Longitude</th><td>${location.coords.longitude}</td></tr><tr><th>Akurasi</th><td>${location.coords.accuracy}</td></tr></tbody></table>`)
                loc = location
            })
            $('.btn-next-third').removeAttr('disabled')
        })
        const webcamElement = document.getElementById('webcam');
        const canvasElement = document.getElementById('canvas');
        const snapSoundElement = document.getElementById('snapSound');
        const webcam = new Webcam(webcamElement, 'user', canvasElement, snapSoundElement);

        $('.btn-next-first').on('click', function() {
            if(type_work == 'WFO') {
                $('.option-wfo').removeAttr('style')
                Instascan.Camera.getCameras().then(cameras => {
                    camera = cameras[0].name;
                    if (cameras.length > 0) {
                        scanner.start(cameras[0]);
                    } else {
                      console.error('No cameras found.');
                    }
                })
                if(type_work == 'WFO') {
                    scanner.addListener('scan', function(content) {
                        $.ajax({
                            url: document.location.origin + '/api/qrcode',
                            dataType: 'json',
                            method: 'get',
                            beforeSend: function(){},
                            success: function(data){
                                if(data.status == 'success') {
                                    if(content == data.data) {
                                        picture = content;
                                        scanner.stop();
                                        Swal.fire('Berhasil', 'Kode QR Sesuai', 'success')
                                        $('.btn-next-second').removeAttr('disabled')
                                    } else {
                                        Swal.fire('Kode QR Salah', 'Cek kembali apakah kode qr tersebut jadwal absensi hari ini! tanyakan admin jika masih bermasalah', 'error')
                                    }
                                } else {
                                    Swal.fire('Tidak ada Jadwal', 'Anda Belum dijadwalkan untuk bekerja secara offline sehingga kode Qr belum terbuat.', 'info')
                                }
                            },
                            error: function(){}
                        })
                    });
                }
            }
            if(type_work == 'WFH') {
                $('.option-wfh').removeAttr('style')
                $('#take_snap').on('click', function() {
                    if(type_work == 'WFH') picture = webcam.snap();
                    if(type_work == 'WFH') $('#snapshoot').attr('src', picture).removeAttr('style')
                    if(type_work == 'WFH') $('.btn-next-second').removeAttr('disabled')
                })

                $('#flip_camera').on('click', function() {
                    if(type_work == 'WFH') webcam.stop()
                    if(type_work == 'WFH') webcam.flip()
                    if(type_work == 'WFH') webcam.start()
                })
            }

            if(type_work == 'WFO') $('.snap_type').text('(WFO) Pastikan Barcode berada di tengah Foto')
            if(type_work == 'WFH') $('.snap_type').text('(WFH) Pastikan Wajah berada di tengah Foto')

            $('.wizard-steps').children('div:nth-child(2)').addClass('wizard-step-active');
            $('.wizard-content').children('div:nth-child(1)').slideToggle(500);
            $('.wizard-content').children('div:nth-child(2)').slideToggle(500);
            if(type_work == 'WFH') webcam.start()
        })

        $('.btn-previous-second').on('click', function() {
            if(type_work == 'WFH') webcam.stop()
            if(type_work == 'WFO') scanner.stop()
            $('.option-wfh').css('display', 'none')
            $('.option-wfo').css('display', 'none')
            $('.wizard-steps').children('div:nth-child(2)').removeClass('wizard-step-active');
            $('.wizard-steps').children('div:nth-child(3)').removeClass('wizard-step-active');
            $('.wizard-content').children('div:nth-child(1)').slideToggle(500);
            $('.wizard-content').children('div:nth-child(2)').slideToggle(500);
        })

        $('.btn-next-second').on('click', function() {
            if(type_work == 'WFH') webcam.stop()
            if(type_work == 'WFO') scanner.stop()
            $('.wizard-steps').children('div:nth-child(3)').addClass('wizard-step-active');
            $('.wizard-content').children('div:nth-child(2)').slideToggle(500);
            $('.wizard-content').children('div:nth-child(3)').slideToggle(500);
        })

        $('.btn-previous-third').on('click', function() {
            if(type_work == 'WFH') webcam.start()
            $('.wizard-steps').children('div:nth-child(3)').removeClass('wizard-step-active');
            $('.wizard-content').children('div:nth-child(2)').slideToggle(500);
            $('.wizard-content').children('div:nth-child(3)').slideToggle(500);
        })



        $('.btn-next-third').on('click', function(e) {
            e.preventDefault()
            Swal.fire({
                title: 'Absen ?',
                text: "Data Absen akan dikirim!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Kirim!',
                cancelButtonText: 'Batalkan'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url : document.location.origin + '/api/absen',
                        type: 'post',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            start_work: $('#start_work').val(),
                            date_work: $('#date_work').val(),
                            type_work,
                            picture,
                            loc
                        },
                        success: function(data) {
                            if(data.status == 'success') {
                                location.href=location.origin + '/absen'
                            } else {
                                Swal.fire('Kesalahan', 'Coba ulangi kembali absensi dan jika masih bermasalah hubungi admin', 'error')
                            }
                        }, error: function() {
                            Swal.fire(
                              'Gagal!',
                              'Terjadi Kesalahan.. Cek Koneksi Internet',
                              'error'
                            )
                        }
                    });
                }
            })
        });
        setInterval(function() {
            let date = new Date();
            let result = date.toISOString().split('T')[0];
            $('#start_work').val(twoDigitTime(date.getHours()) + ':' + twoDigitTime(date.getMinutes()))
            $('#date_work').val(result)
        }, 1000);

        function twoDigitTime(time) {
            if(time < 10) {
                return '0' + time
            }
            return time
        }
    }
}
if(document.location.pathname.split('/')[1] == 'pribadi') {
    let defaultImageProfile = '', reader
    var output = document.getElementById('img-profile-photo');
    $('#image-profile').on('input', function(event) {
        defaultImageProfile = output.src
        reader = new FileReader();
        reader.onload = function(){
          output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
        $('.btn-reload-profile').slideToggle(200)
    });
    $('.btn-reload-profile').on('click', function() {
        $('.btn-reload-profile').slideToggle(200)
        output.src = defaultImageProfile
    })
    $("#btn-change-pw").fireModal({
        title: 'Ganti Password',
        body: $("#modal-change-password"),
        footerClass: 'bg-whitesmoke',
        autoFocus: false,
        onFormSubmit: function(modal, e, form) {
            if($('.input-password').val() == "" || $('.input-password-confirm').val() == ""){
                form.stopProgress();
                modal.find('.modal-body').children('.alert').remove()
                modal.find('.modal-body').prepend('<div class="alert alert-danger">Password / Konfirmasi Password harus Diisi!</div>')
            } else if($('.input-password').val() != $('.input-password-confirm').val()){
                form.stopProgress();
                modal.find('.modal-body').children('.alert').remove()
                modal.find('.modal-body').prepend('<div class="alert alert-danger">Konfirmasi Password Tidak sesuai!</div>')
            }  else {
                $.ajax({
                    url : document.location.origin + '/api'  + document.location.pathname,
                    type: 'post',
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'password':  $('.input-password').val(),
                    },
                    success: async function(data) {
                        form.stopProgress();
                        modal.find('.modal-body').children('.alert').remove()
                        modal.find('.modal-body').prepend('<div class="alert alert-success">Password telah diganti</div>')
                        $('.input-password').val('')
                        $('.input-password-confirm').val('')
                    }, error: function() {
                        form.stopProgress();
                        modal.find('.modal-body').children('.alert').remove()
                        modal.find('.modal-body').prepend('<div class="alert alert-danger">Terdapat kesalahan. Cek kembali Rule Pengisian dan internet anda</div>')
                    }
                })
            }
            e.preventDefault();
        },
        shown: function(modal, form) {},
        buttons: [
            {
                text: 'Ganti Password',
                submit: true,
                class: 'btn btn-primary btn-shadow',
                handler: function(modal) {
                }
            }
        ]
    });
    let sig = $('.kbw-signature').signature();

        $('.btn-show-sig').on('click', function() {
            $.ajax({
                url : document.location.origin + '/api/signature/employee',
                type: 'post',
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                },
                dataType: 'json',
                success: function(data) {
                    if(data.status == 'success') {
                        sig.signature('draw', data.sig)
                        $('.btn-show-sig').parent().children('div.kbw-signature').slideToggle('slow')
                        $('.btn-show-sig').parent().children('div.btn-sig').children().children().slideToggle('slow')
                    } else {
                        $('.btn-show-sig').parent().children('p').text('Belum ada TTD').slideToggle('slow')
                    }
                }, error: function() {
                }
            })
        })

        $('.btn-save-signature').on('click', function() {
            Swal.fire({
                title: 'Simpan TTD ?',
                text: "Tanda Tangan akan Disimpan!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Simpan!',
                cancelButtonText: 'Batalkan'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url : document.location.origin + '/api/signature',
                        type: 'post',
                        data: {
                            _method: 'put',
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            sig: $('.kbw-signature').signature('toJSON'),
                            sig_svg: sig.signature('toSVG'),
                            user_id: $(this).data('id')
                        },
                        success: function() {
                            Swal.fire(
                                'Berhasil!',
                                'Tanda Tangan berhasil disimpan',
                                'success'
                            )
                        }, error: function() {
                            Swal.fire(
                              'Gagal!',
                              'Terjadi Kesalahan.. Cek Koneksi Internet',
                              'error'
                            )
                        }
                    });
                }
            })
        });
        $('#clear').on('click', function() {
            sig.signature('clear');
        })
        $('#finish_sig').on('click', function() {
            var enable = $(this).text() === 'Enable';
            $(this).text(enable ? 'Disable' : 'Enable')
            sig.signature(enable ? 'enable' : 'disable')
        })
}

