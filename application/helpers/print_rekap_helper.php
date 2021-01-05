<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once "fpdf/fpdf.php"; 

class Reportbulan extends FPDF
{
  var $widths;
  var $aligns;

  function SetWidths($w){
    $this->widths=$w;
  }

  function SetAligns($a){
    $this->aligns=$a;
  }

  function Row($data){
    $nb=0;
    for($i=0;$i<count($data);$i++)
      $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    $h=(4*$nb);
    $this->CheckPageBreak($h);
    for($i=0;$i<count($data);$i++)
    {
     $w = $this->widths[$i];
     $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
     $x = $this->GetX();
     $y = $this->GetY();
     $this->Rect($x,$y,$w,$h);
     $this->MultiCell($w,6,$data[$i],0,$a); // ganti ukuran lineheight css
     $this->SetXY($x+$w,$y);
    } 
    $this->Ln($h);
  }

  function Row_Aktifitas($data){
    $nb=0;
    for($i=0;$i<count($data);$i++)
      $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    $h=(10*$nb);
    $this->CheckPageBreak($h);
    for($i=0;$i<count($data);$i++)
    {
     $w = $this->widths[$i];
     $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
     $x = $this->GetX();
     $y = $this->GetY();
     $this->Rect($x,$y,$w,$h);
     $this->MultiCell($w,8,$data[$i],0,$a); // ganti ukuran lineheight css
     $this->SetXY($x+$w,$y);
    } 
    $this->Ln($h);
  }

  function CheckPageBreak($h){
    if($this->GetY()+$h>$this->PageBreakTrigger)
    $this->AddPage($this->CurOrientation);
  }

  function NbLines($w,$txt){
    $cw=&$this->CurrentFont['cw'];
    if($w==0)
     $w=$this->w-$this->rMargin-$this->x;
    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
    $s=str_replace("r",'',$txt);
    $nb=strlen($s);
    if($nb>0 and $s[$nb-1]=="n")
     $nb--;
    $sep=-1;
    $i=0;
    $j=0;
    $l=0;
    $nl=1;
    while($i<$nb)
    {
     $c=$s[$i];
     if($c=="n")
     {
      $i++;
      $sep=-1;
      $j=$i;
      $l=0;
      $nl++;
      continue;
     }
     if($c==' ')
      $sep=$i;
     $l+=$cw[$c];
     if($l>$wmax)
     {
      if($sep==-1)
      {
       if($i==$j)
        $i++;
      }
      else
       $i=$sep+1;
      $sep=-1;
      $j=$i;
      $l=0;
      $nl++;
     }
     else
     $i++;
   }
   return $nl;
  }


  function Header()
  {
    $this->Image(base_url('assets/image/img_laporan/all.png'), 0, 0, 213, 300, 'png');
  }

  function Sector($xc, $yc, $r, $a, $b, $style='FD', $cw=true, $o=90)
  {
      $d0 = $a - $b;
      if($cw){
          $d = $b;
          $b = $o - $a;
          $a = $o - $d;
      }else{
          $b += $o;
          $a += $o;
      }
      while($a<0)
          $a += 360;
      while($a>360)
          $a -= 360;
      while($b<0)
          $b += 360;
      while($b>360)
          $b -= 360;
      if ($a > $b)
          $b += 360;
      $b = $b/360*2*M_PI;
      $a = $a/360*2*M_PI;
      $d = $b - $a;
      if ($d == 0 && $d0 != 0)
          $d = 2*M_PI;
      $k = $this->k;
      $hp = $this->h;
      if (sin($d/2))
          $MyArc = 4/3*(1-cos($d/2))/sin($d/2)*$r;
      else
          $MyArc = 0;
      //first put the center
      $this->_out(sprintf('%.2F %.2F m',($xc)*$k,($hp-$yc)*$k));
      //put the first point
      $this->_out(sprintf('%.2F %.2F l',($xc+$r*cos($a))*$k,(($hp-($yc-$r*sin($a)))*$k)));
      //draw the arc
      if ($d < M_PI/2){
          $this->_Arc($xc+$r*cos($a)+$MyArc*cos(M_PI/2+$a),
                      $yc-$r*sin($a)-$MyArc*sin(M_PI/2+$a),
                      $xc+$r*cos($b)+$MyArc*cos($b-M_PI/2),
                      $yc-$r*sin($b)-$MyArc*sin($b-M_PI/2),
                      $xc+$r*cos($b),
                      $yc-$r*sin($b)
                      );
      }else{
          $b = $a + $d/4;
          $MyArc = 4/3*(1-cos($d/8))/sin($d/8)*$r;
          $this->_Arc($xc+$r*cos($a)+$MyArc*cos(M_PI/2+$a),
                      $yc-$r*sin($a)-$MyArc*sin(M_PI/2+$a),
                      $xc+$r*cos($b)+$MyArc*cos($b-M_PI/2),
                      $yc-$r*sin($b)-$MyArc*sin($b-M_PI/2),
                      $xc+$r*cos($b),
                      $yc-$r*sin($b)
                      );
          $a = $b;
          $b = $a + $d/4;
          $this->_Arc($xc+$r*cos($a)+$MyArc*cos(M_PI/2+$a),
                      $yc-$r*sin($a)-$MyArc*sin(M_PI/2+$a),
                      $xc+$r*cos($b)+$MyArc*cos($b-M_PI/2),
                      $yc-$r*sin($b)-$MyArc*sin($b-M_PI/2),
                      $xc+$r*cos($b),
                      $yc-$r*sin($b)
                      );
          $a = $b;
          $b = $a + $d/4;
          $this->_Arc($xc+$r*cos($a)+$MyArc*cos(M_PI/2+$a),
                      $yc-$r*sin($a)-$MyArc*sin(M_PI/2+$a),
                      $xc+$r*cos($b)+$MyArc*cos($b-M_PI/2),
                      $yc-$r*sin($b)-$MyArc*sin($b-M_PI/2),
                      $xc+$r*cos($b),
                      $yc-$r*sin($b)
                      );
          $a = $b;
          $b = $a + $d/4;
          $this->_Arc($xc+$r*cos($a)+$MyArc*cos(M_PI/2+$a),
                      $yc-$r*sin($a)-$MyArc*sin(M_PI/2+$a),
                      $xc+$r*cos($b)+$MyArc*cos($b-M_PI/2),
                      $yc-$r*sin($b)-$MyArc*sin($b-M_PI/2),
                      $xc+$r*cos($b),
                      $yc-$r*sin($b)
                      );
      }
      //terminate drawing
      if($style=='F')
          $op='f';
      elseif($style=='FD' || $style=='DF')
          $op='b';
      else
          $op='s';
      $this->_out($op);
  }
  
  function _Arc($x1, $y1, $x2, $y2, $x3, $y3 )
  {
      $h = $this->h;
      $this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c',
          $x1*$this->k,
          ($h-$y1)*$this->k,
          $x2*$this->k,
          ($h-$y2)*$this->k,
          $x3*$this->k,
          ($h-$y3)*$this->k));
  }

  public function create_chart($data = array(), $position = array())
  {
    //pie and legend properties
    $pieX = $position['pieX'];
    $pieY = $position['pieY'];
    $r = $position['r'];//radius
    $legendX = $position['legendX'];
    $legendY = $position['legendY'];
    $labelY = $position['labelY'];
    $caption = $position['captionLabelY'];

    $legendX30 = $legendX + 40;
    $legendY30 = $legendY;

    $legendX60 = $legendX30 + 40;
    $legendY60 = $legendY30;

    $dataSum = 0;
    foreach($data as $item){
      $dataSum += $item['value'];
    }

    $degUnit = 360 / $dataSum;
    $currentAngle = 0;
    $currentLegendY = $legendY;
    $currentLegendY30 = $legendY30;
    $currentLegendY60 = $legendY60;

    $this->SetFont('Times','',12);
    $nolegend = 1;

    $this->SetFont('Times','B',12);
    $this->Cell($labelY,5,$caption,0,0);
    $this->SetFont('Times','',12);

    foreach($data as $index => $item){
      $deg = $degUnit * $item['value'];
      $this->SetFillColor($item['color'][0],$item['color'][1],$item['color'][2]);
      $this->SetDrawColor($item['color'][0],$item['color'][1],$item['color'][2]);
      $this->Sector($pieX,$pieY,$r,$currentAngle,$currentAngle+$deg);
      $currentAngle+=$deg;
      
      //draw the legend
      if ($nolegend <= 25 ) {
          $this->Rect($legendX,$currentLegendY,5,5,'DF');
          $this->SetXY($legendX + 7,$currentLegendY);
          $this->MultiCell(95,5,str_replace('–', '-', $index),0,'L',0,0);
          if (strlen($index) > 40 && strlen($index) < 71) {
            $currentLegendY += 11;
          }else if (strlen($index) > 70) {
            $currentLegendY += 16;
          }else{
            $currentLegendY += 6;
          }
      } 

      if ($nolegend > 25 && $nolegend <= 50) {
          $this->Rect($legendX30,$currentLegendY30,5,5,'DF');
          $this->SetXY($legendX30 + 7,$currentLegendY30);
          $this->Cell(40,5,str_replace('–', '-', $index),0,0);
          $currentLegendY30 += 6;
      }

      if ($nolegend > 50) {
          $this->Rect($legendX60,$currentLegendY60,5,5,'DF');
          $this->SetXY($legendX60 + 7,$currentLegendY60);
          $this->Cell(40,5,str_replace('–', '-', $index),0,0);
          $currentLegendY60 += 6;
      }

      $nolegend++;
    }

  }

  function MultiCell($w, $h, $txt, $border=0, $align='J', $fill=false, $indent=0)
  {
      //Output text with automatic or explicit line breaks
      $cw=&$this->CurrentFont['cw'];
      if($w==0)
          $w=$this->w-$this->rMargin-$this->x;

      $wFirst = $w-$indent;
      $wOther = $w;

      $wmaxFirst=($wFirst-2*$this->cMargin)*1000/$this->FontSize;
      $wmaxOther=($wOther-2*$this->cMargin)*1000/$this->FontSize;

      $s=str_replace("\r",'',$txt);
      $nb=strlen($s);
      if($nb>0 && $s[$nb-1]=="\n")
          $nb--;
      $b=0;
      if($border)
      {
          if($border==1)
          {
              $border='LTRB';
              $b='LRT';
              $b2='LR';
          }
          else
          {
              $b2='';
              if(is_int(strpos($border,'L')))
                  $b2.='L';
              if(is_int(strpos($border,'R')))
                  $b2.='R';
              $b=is_int(strpos($border,'T')) ? $b2.'T' : $b2;
          }
      }
      $sep=-1;
      $i=0;
      $j=0;
      $l=0;
      $ns=0;
      $nl=1;
          $first=true;
      while($i<$nb)
      {
          //Get next character
          $c=$s[$i];
          if($c=="\n")
          {
              //Explicit line break
              if($this->ws>0)
              {
                  $this->ws=0;
                  $this->_out('0 Tw');
              }
              $this->Cell($w,$h,substr($s,$j,$i-$j),$b,2,$align,$fill);
              $i++;
              $sep=-1;
              $j=$i;
              $l=0;
              $ns=0;
              $nl++;
              if($border && $nl==2)
                  $b=$b2;
              continue;
          }
          if($c==' ')
          {
              $sep=$i;
              $ls=$l;
              $ns++;
          }
          $l+=$cw[$c];

          if ($first)
          {
              $wmax = $wmaxFirst;
              $w = $wFirst;
          }
          else
          {
              $wmax = $wmaxOther;
              $w = $wOther;
          }

          if($l>$wmax)
          {
              //Automatic line break
              if($sep==-1)
              {
                  if($i==$j)
                      $i++;
                  if($this->ws>0)
                  {
                      $this->ws=0;
                      $this->_out('0 Tw');
                  }
                  $SaveX = $this->x; 
                  if ($first && $indent>0)
                  {
                      $this->SetX($this->x + $indent);
                      $first=false;
                  }
                  $this->Cell($w,$h,substr($s,$j,$i-$j),$b,2,$align,$fill);
                      $this->SetX($SaveX);
              }
              else
              {
                  if($align=='J')
                  {
                      $this->ws=($ns>1) ? ($wmax-$ls)/1000*$this->FontSize/($ns-1) : 0;
                      $this->_out(sprintf('%.3f Tw',$this->ws*$this->k));
                  }
                  $SaveX = $this->x; 
                  if ($first && $indent>0)
                  {
                      $this->SetX($this->x + $indent);
                      $first=false;
                  }
                  $this->Cell($w,$h,substr($s,$j,$sep-$j),$b,2,$align,$fill);
                      $this->SetX($SaveX);
                  $i=$sep+1;
              }
              $sep=-1;
              $j=$i;
              $l=0;
              $ns=0;
              $nl++;
              if($border && $nl==2)
                  $b=$b2;
          }
          else
              $i++;
      }
      //Last chunk
      if($this->ws>0)
      {
          $this->ws=0;
          $this->_out('0 Tw');
      }
      if($border && is_int(strpos($border,'B')))
          $b.='B';
      $this->Cell($w,$h,substr($s,$j,$i),$b,2,$align,$fill);
      $this->x=$this->lMargin;
    } 

}

?>