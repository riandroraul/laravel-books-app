for (let i = 1; i <= 100; i++) {
  if(i % 3 == 0 && i % 5 == 0){
    console.log('TigaLima');
    
  } else if(i % 3 == 0){
    console.log('Tiga');
    
  } else if(i % 5 == 0){
    console.log('Lima');
    
  } else {
    console.log(i);
  }
}