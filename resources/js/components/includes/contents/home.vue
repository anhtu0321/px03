<template>
    <div class="content__sub mt-3">
        <div class="content__list mb-3 mt-3">
            <canvas id="canvas"></canvas>
        </div>
        <div class="bg-info text-light col-md-12 mb-3 content__header">THỐNG KÊ XỬ LÝ CÔNG VIỆC</div>
        <div class="content__list mb-3 mt-3">
            <table class="table text-center">
                <thead>
                    <th>Tổng số</th>
                    <th>Hoàn thành</th>
                    <th>Thất bại</th>
                    <th>Chưa xử lý</th>
                    <th>Đang xử lý</th>
                    <th>Quá hạn</th>
                </thead>
                <tbody>
                    <tr>
                        <td><div class="bg-primary text-white">{{ dataThongKe.tongso}}</div></td>
                        <td><div class="bg-success text-white">{{ dataThongKe.hoanthanh}}</div></td>
                        <td><div class="bg-danger text-white">{{ dataThongKe.thatbai}}</div></td>
                        <td><div class="bg-warning text-white">{{ dataThongKe.chuaxuly}}</div></td>
                        <td><div class="bg-info text-white">{{ dataThongKe.dangxuly}}</div></td>
                        <td><div class="bg-danger text-white">{{ dataThongKe.quahan}}</div></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            ctx: null,
            tamX:'',
            tamY:'',
            dataThongKe:'',
            toado:'',
        }
    },
    methods:{
        thongke(){
            axios.get('/px03/public/api/thongke')
            .then( response => {
                var data = response.data.data;
                this.bieudotron(data.bieudotron);
                this.dataThongKe = data.xulycongviec;
            })
            
        },
        configCanvas(){
            var canvas = document.getElementById("canvas");
            var div = canvas.parentNode;
            var cx = canvas.getContext("2d");  
            canvas.height = window.innerHeight/3;
            canvas.width = div.offsetWidth;
            this.tamX = canvas.width/2;
            this.tamY = canvas.height/2;
            this.ctx = cx;
        },
        bieudotron(data){
            var tong = data.reduce((sum, e)=>{
                return sum = sum + e.soluong
            },0);
            var gocBatDau = 0;
            var p = Math.PI;
            for(var i in data){
                var daiCung = data[i].soluong/tong*2*p;
                var phantram = Math.round(data[i].soluong/tong*100) +'%';
                var gocKetThuc = daiCung + gocBatDau;
                
                // vẽ cung tròn
                this.ctx.beginPath();
                this.ctx.fillStyle = data[i].mausac;
                this.ctx.arc(this.tamX, this.tamY, 100, gocBatDau, gocKetThuc);
                this.ctx.lineTo(this.tamX, this.tamY);
                this.ctx.closePath();
                this.ctx.fill();
                var x = this.tamX + 100*Math.cos(gocBatDau + daiCung/2);
                var y = this.tamY + 100*Math.sin(gocBatDau + daiCung/2);
                var xPlus = this.tamX + 120*Math.cos(gocBatDau + daiCung/2);
                var yPlus = this.tamY + 120*Math.sin(gocBatDau + daiCung/2);
                // Vẽ đường kẻ chú thích
                this.ctx.beginPath();
                this.ctx.moveTo(x,y);
                this.ctx.lineTo(xPlus,yPlus);
                xPlus>=this.tamX? this.ctx.lineTo(xPlus+200,yPlus):this.ctx.lineTo(xPlus-200,yPlus);
                this.ctx.stroke();
                // Text chú thích
                this.ctx.font = "14px Tahoma";
                this.ctx.fillStyle = "fushsia";
                var xText, yText;
                x >= this.tamX? xText = x + 20: xText = x -210;
                y >= this.tamY? yText = y + 20*Math.sin(gocBatDau + daiCung/2) - 5: yText = y + 20*Math.sin(gocBatDau + daiCung/2) - 5;
                this.ctx.fillText(data[i].name + ': '+ data[i].soluong + ' ( ' + phantram + ' )', xText, yText);
                gocBatDau = gocKetThuc;
            }
            
        }
        
    },

    mounted(){
        this.thongke();
        this.configCanvas();
        
    }
}
</script>

<style scoped>
.content__list{
    min-height: 300px;
}

</style>