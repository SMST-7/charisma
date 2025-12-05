@extends('panel.layouts.master')
@section('title','کوپن')

@section('top_page')
    <x-top-page title="فرم ایجاد کوپن" :items="['فروشگاه','فرم ایجاد کوپن']" homeUrl="/" />
@endsection

@section('content')
    <div class="col-sm-12 col-xl-8">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>فرم کوپن</h5>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                            <form class="theme-form" action="{{ route('coupon.store') }}" method="POST">
                                @csrf

                                {{-- کد کوپن --}}
                                <div class="mb-3">
                                    <label for="code" class="col-form-label pt-0">کد کوپن <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="code" name="code" placeholder="مثال: SUMMER25" value="{{ old('code') }}" required maxlength="20" pattern="[A-Za-z0-9]+" title="کد کوپن فقط شامل حروف و اعداد باشد">
                                    @error('code') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                {{-- نوع تخفیف --}}
                                <div class="mb-3">
                                    <label for="type" class="col-form-label pt-0">نوع تخفیف <span class="text-danger">*</span></label>
                                    <select class="form-control" id="type" name="type" required>
                                        <option value="" disabled {{ old('type') ? '' : 'selected' }}>نوع تخفیف را انتخاب کنید</option>
                                        <option value="percent" {{ old('type') == 'percent' ? 'selected' : '' }}>درصدی</option>
                                        <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}>مبلغ ثابت</option>
                                    </select>
                                    @error('type') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                {{-- مقدار تخفیف --}}
                                <div class="mb-3">
                                    <label for="value" class="col-form-label pt-0">مقدار تخفیف <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="value" name="value" placeholder="مثال: 25.00 برای 25%" value="{{ old('value') }}" required step="0.01" min="0">
                                    @error('value') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                {{-- حداقل مبلغ خرید --}}
                                <div class="mb-3">
                                    <label for="min_order_amount" class="col-form-label pt-0">حداقل مبلغ خرید</label>
                                    <input type="number" class="form-control" id="min_order_amount" name="min_order_amount" placeholder="مثال: 100000" value="{{ old('min_order_amount') }}" step="0.01" min="0">
                                    @error('min_order_amount') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                {{-- سقف استفاده --}}
                                <div class="mb-3">
                                    <label for="usage_limit" class="col-form-label pt-0">سقف استفاده</label>
                                    <input type="number" class="form-control" id="usage_limit" name="usage_limit" placeholder="مثال: 100" value="{{ old('usage_limit') }}" min="1">
                                    @error('usage_limit') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="form-group">
                                    <label for="start_date">تاریخ شروع:</label>
                                    <input type="text" id="start_date" value="{{ old('start_date') }}" name="start_date" class="form-control" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="end_date">تاریخ پایان:</label>
                                    <input type="text" id="end_date" value="{{ old('end_date') }}" name="end_date" class="form-control" readonly>
                                </div>

{{--                                --}}{{-- تاریخ شروع --}}
{{--                                <div class="mb-3">--}}
{{--                                    <label for="start_date" class="col-form-label pt-0">تاریخ شروع</label>--}}
{{--                                    <input type="datetime-local" class="form-control" id="start_date" name="start_date" value="{{ old('start_date') }}">--}}
{{--                                    @error('start_date') <small class="text-danger">{{ $message }}</small> @enderror--}}
{{--                                </div>--}}

{{--                                --}}{{-- تاریخ پایان --}}
{{--                                <div class="mb-3">--}}
{{--                                    <label for="end_date" class="col-form-label pt-0">تاریخ پایان</label>--}}
{{--                                    <input type="datetime-local" class="form-control" id="end_date" name="end_date" value="{{ old('end_date') }}">--}}
{{--                                    @error('end_date') <small class="text-danger">{{ $message }}</small> @enderror--}}
{{--                                </div>--}}

                                {{-- وضعیت فعال --}}
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="active" name="active" value="1" {{ old('active', 1) ? 'checked' : '' }}>
                                        <label for="active" class="form-check-label">کوپن فعال باشد</label>
                                    </div>
                                    @error('active') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                {{-- دکمه‌ها --}}
                                <div class="card-footer d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">ایجاد</button>
                                    <a href="{{ route('coupon.index') }}" class="btn btn-secondary">لغو</a>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ================= Persian DateTime Picker ================= -->
    <style>
        .persian-dtp {
            position: absolute;
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
            font-family: sans-serif;
            width: 260px;
            z-index: 1000;
            display: none;
        }
        .pdtp-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 5px;
        }
        .pdtp-header button {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        .pdtp-days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            text-align: center;
            gap: 2px;
        }
        .pdtp-days div {
            padding: 5px 0;
            border-radius: 5px;
            cursor: pointer;
        }
        .pdtp-days div:hover {
            background: #e0f0ff;
        }
        .pdtp-selected {
            background: #007bff;
            color: white;
        }
        .pdtp-time {
            margin-top: 8px;
            text-align: center;
        }
        .pdtp-time input {
            width: 50px;
            text-align: center;
        }
    </style>

    <script>
        // ================= Persian DateTime Picker (Vanilla JS) =================
        (() => {
            // تبدیل میلادی به شمسی (محاسبه تقریبی برای نمایش تقویم)
            function toJalali(gY, gM, gD){
                const gDays=[31,28,31,30,31,30,31,31,30,31,30,31];
                let gy=gY-1600, gm=gM-1, gd=gD-1;
                let gDayNo=365*gy+Math.floor((gy+3)/4)-Math.floor((gy+99)/100)+Math.floor((gy+399)/400);
                for(let i=0;i<gm;++i) gDayNo+=gDays[i];
                if(gM>2 && ((gY%4==0 && gY%100!=0)|| (gY%400==0))) gDayNo++;
                gDayNo+=gd;
                let jDayNo=gDayNo-79;
                let jNp=Math.floor(jDayNo/12053); jDayNo%=12053;
                let jy=979+33*jNp+4*Math.floor(jDayNo/1461);
                jDayNo%=1461;
                if(jDayNo>=366){jy+=Math.floor((jDayNo-1)/365); jDayNo=(jDayNo-1)%365;}
                const jMonths=[31,31,31,31,31,31,30,30,30,30,30,29];
                let jm, jd;
                for(jm=0; jm<11 && jDayNo>=jMonths[jm]; ++jm) jDayNo-=jMonths[jm];
                jd=jDayNo+1;
                return [jy,jm+1,jd];
            }

            function nowJalali(){
                const g=new Date();
                const [jy,jm,jd]=toJalali(g.getFullYear(), g.getMonth()+1, g.getDate());
                return {jy,jm,jd, h:g.getHours(), m:g.getMinutes(), s:g.getSeconds()};
            }

            const months=["فروردین","اردیبهشت","خرداد","تیر","مرداد","شهریور","مهر","آبان","آذر","دی","بهمن","اسفند"];

            function PersianPicker(input){
                const picker=document.createElement("div");
                picker.className="persian-dtp";
                document.body.appendChild(picker);

                let {jy,jm,jd,h,m,s}=nowJalali();
                function render(){
                    picker.innerHTML="";
                    const header=document.createElement("div");
                    header.className="pdtp-header";
                    const prev=document.createElement("button"); prev.textContent="◀";
                    const next=document.createElement("button"); next.textContent="▶";
                    const title=document.createElement("span");
                    title.textContent=`${months[jm-1]} ${jy}`;
                    header.append(prev,title,next);
                    picker.append(header);

                    const days=document.createElement("div");
                    days.className="pdtp-days";
                    const daysInMonth = jm<=6 ? 31 : (jm<=11 ? 30 : ((jy%4===3)?30:29));
                    for(let i=1;i<=daysInMonth;i++){
                        const d=document.createElement("div");
                        d.textContent=i;
                        if(i===jd) d.classList.add("pdtp-selected");
                        d.onclick=()=>{
                            jd=i;
                            const hh=String(h).padStart(2,"0");
                            const mm=String(m).padStart(2,"0");
                            const ss=String(s).padStart(2,"0");
                            input.value=`${jy}/${String(jm).padStart(2,"0")}/${String(jd).padStart(2,"0")} ${hh}:${mm}:${ss}`;
                            picker.style.display="none";
                        };
                        days.appendChild(d);
                    }
                    picker.append(days);

                    const timeDiv=document.createElement("div");
                    timeDiv.className="pdtp-time";
                    timeDiv.innerHTML = `
                      <label>ساعت:</label>
                      <input type="number" min="0" max="59" value="${s}" id="s_${input.id}">
                      :
                      <input type="number" min="0" max="59" value="${m}" id="m_${input.id}">
                      :
                      <input type="number" min="0" max="23" value="${h}" id="h_${input.id}">
                    `;

                    picker.append(timeDiv);

                    prev.onclick=()=>{jm--; if(jm<1){jm=12;jy--;} render();};
                    next.onclick=()=>{jm++; if(jm>12){jm=1;jy++;} render();};

                    // بروزرسانی زمان هنگام تغییر
                    timeDiv.querySelectorAll('input').forEach(inp => {
                        inp.oninput = () => {
                            h = parseInt(document.getElementById(`h_${input.id}`).value) || 0;
                            m = parseInt(document.getElementById(`m_${input.id}`).value) || 0;
                            s = parseInt(document.getElementById(`s_${input.id}`).value) || 0;

                            const hh = String(h).padStart(2, "0");
                            const mm = String(m).padStart(2, "0");
                            const ss = String(s).padStart(2, "0");
                            const formattedDate = `${jy}/${String(jm).padStart(2, "0")}/${String(jd).padStart(2, "0")} ${hh}:${mm}:${ss}`;
                            input.value = formattedDate;
                        };
                    });

                }

                input.addEventListener("click", e=>{
                    const rect=input.getBoundingClientRect();
                    picker.style.left=rect.left+"px";
                    picker.style.top=(rect.bottom+window.scrollY)+"px";
                    picker.style.display="block";
                    render();
                });

// جلوگیری از بسته شدن هنگام کلیک داخل تقویم
                picker.addEventListener("click", function(e) {
                    e.stopPropagation();
                });

                document.addEventListener("click", e=>{
                    if(!picker.contains(e.target) && e.target!==input) picker.style.display="none";
                });

            }

            window.addEventListener("DOMContentLoaded", ()=>{
                const s=document.getElementById("start_date");
                const e=document.getElementById("end_date");
                if(s) PersianPicker(s);
                if(e) PersianPicker(e);
            });
        })();
    </script>
    <!-- ============================================================ -->

@endsection


