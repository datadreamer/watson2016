

ArrayList<Bar> bars;
int topValue = 0;
float heightScale, widthScale;
color[] colors = [#0099dd, #22bbee, #66ddff];

void setup(){
  //size(500,500);
  jProcessingJS(this);
  bars = new ArrayList<Bar>();
  for(int i=0; i<bargraphvalues.length(); i++){
    String name = bargraphvalues[i][0];
    int val = int(bargraphvalues[i][1]);
    if(val > topValue){
      topValue = val;
    }
    //color c = color(bargraphcolors[i]);
    color c = colors[i];
    bars.add(new Bar(name, val, c));
  }
  barWidth = (width - ((bars.size()-1) * 10)) / bars.size();
  widthScale = (width - 40) / bars.size();
  heightScale = (height - 50) / topValue;
  textSize(18);
  textAlign(CENTER);
  noStroke();
}

void draw(){
  background(255);
  int i = 0;
  for(Bar bar: bars){
    pushMatrix();
    translate(i * (widthScale+10) + 10, 10);
    bar.draw();
    popMatrix();
    i++;
  }
}

class Bar{
  String name;
  int value;
  color c;
  
  Bar(String name, int value, color c){
    this.name = name;
    this.value = value;
    this.c = c;
    println(c +" "+ red(c) +" "+ green(c) +" "+ blue(c));
  }
  
  void draw(){
    fill(c);
    rect(0, height - 50, widthScale, 0 - (value * heightScale));
    text(name +": "+ value, widthScale/2, height - 20);
  }
}

