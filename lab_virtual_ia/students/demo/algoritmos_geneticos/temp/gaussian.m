function z = gauss(x,b,c)

    num = -(x-b).^2;
    den = 2*(c^2);
    pot = num./den;
    z =e.^(pot);

endfunction


%gauss(x, media, variancia)

plot(-50:50,gauss(-50:50, 0,20))
print("-dpng","teste.png","-S600,600")
