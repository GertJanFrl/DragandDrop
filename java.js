 var internalDNDType = 'text/woord'; //Het type van de drag and drop data.
 var currentElement;				//Het laatst gesleepte element.
 var  succesCount = 0;				//Het aantal goede pogingen.
 var  total; //Het aantal woorden/afbeeldingen.
 var imageContainer;	//De DIV waar de afbeeldingen in staan, dit word gebruikt om de eind text te veranderen.
 var mistakes = 0; //Het aantal foute pogingen
 var scoreboard; //De DIV van het scorebord.
 var SoundContainer;	//De hidden DIV waar het geluid in wordt afgespeeld.
 var bCanPlaySound = true;	//Een boolean die aangeeft of er al weer een geluid mag worden afgespeeld, voor een bugfix.
 var currentValue = "";
 
 
 function init() {
 
   scoreboard = document.getElementById('TopscoreBoard'); //De DIV van het scorebord.
  SoundContainer = document.getElementById('soundCont');	//De hidden DIV waar het geluid in wordt afgespeeld.
   total = document.querySelectorAll(".dragableWord").length; //Het aantal woorden/afbeeldingen.
  imageContainer = document.getElementById('afbeeldingwrapper');	//De DIV waar de afbeeldingen in staan, dit word gebruikt om de eind text te veranderen.
 
 
 /* Hang een eventlistener aan alle dropzones */
 var afb = document.querySelectorAll('#afbeeldingwrapper .dropZone');
[].forEach.call(afb, function(imgs) {

imgs.addEventListener('drop', handleDrop, false);
  imgs.addEventListener('dragenter', handleDragEnter, false);
  imgs.addEventListener('dragover', handleDragOver, false);
  imgs.addEventListener('dragleave', handleDragLeave, false);
  
 
});
/* Hang een eventlistener aan alle draggable woorden */
var dWords = document.querySelectorAll('.dragableWord');
[].forEach.call(dWords, function(wordd) {
  wordd.addEventListener('dragstart', handleDragStart, false);
   wordd.addEventListener('dragend', handleDragEnd, false);
	//wordd.bind('selectstart', function(){this.dragDrop(); return false;});
	
    //wordd.bind('mousemove', handleDragMouseMove);

});
 }
 
 
 
 
/* De drag start handler */
function handleDragStart(e) {
 
   if (e.target instanceof HTMLLIElement) { 
      
      e.dataTransfer.setData(internalDNDType, e.target.dataset.value); //Set het datatype van de drag..
	  currentValue = e.target.dataset.value;
	  console.log("CV: "+currentValue);
      e.target.style.color = '#FFFFFF';	//Verander de css kleur property van het element.
	  e.target.style.opacity = '0.4';	//Verander de css opacity(doorzichtigheid) property van het element.
	  currentElement = e.target;		//Set het currentElement variabel(het laatst gesleepte element).
	  CurrentWord = e.target.innerHTML;	//Set het currentWord variabel(het woord van het laatst gesleepte element).
	  
    } else {
      e.preventDefault(); //Voorkom dat het standaart event word uitgevoerd(text selectie)..
    }
}

function handleDragOver(e) {
  if (e.preventDefault) {
    e.preventDefault(); //Voorkom dat het standaart event word uitgevoerd(de browser redirect).
  }

  e.dataTransfer.dropEffect = 'move';	//Zet het type drag and drop.

  return false;
}

function handleDragEnter(e) {
 /* Dummy functie. Wordt misschien nog gebruikt, gebruik nu namelijk de CSS hover. */
}

function handleDragLeave(e) {
 /* Dummy functie. Wordt misschien nog gebruikt, gebruik nu namelijk de CSS hover. */
}

/* De drop handler */
function handleDrop(e) {
   var data = e.dataTransfer.getData(internalDNDType); //Set het dnd type..
   //document.write("eTarget: "+e.target.dataset.value+" Data: "+data
   if(e.target.dataset.value.toString() == currentValue) //Als de target index het zelfde is als de source index, is het antwoord goed.
{
succesCount = succesCount + 1; //Tel 1 bij de goede antwoorden op.
e.target.setAttribute("dropzone",""); //Poging om het drop area te disabelen. Werkt niet.
e.target.className = 'dropZoneGOED'; //Verander de class van de droparea DIV.
e.target.innerHTML = "<div class='PlaySoundBut' onClick=SoundPlay('"+currentElement.innerHTML+"');>"+currentElement.innerHTML+"</div>"; //Add het knopje
currentElement.parentNode.removeChild(currentElement); //Verwijder het woord uit de lijst.
if(succesCount == total) //Als alles is ingevuld
	{
		document.getElementById('einde').innerHTML = "Opdracht klaar, je hebt "+mistakes.toString()+" fouten gemaakt.</br>Klik <a href='javascript:location.reload(true)'>hier</a> om nog een keer te gaan.."; //Verander de content van de einde div
	}

}
else // Als het antwoord fout is..
{
var timer=setTimeout(function(){resetText(e.target)}, 1000); //Set een timer
e.target.className = 'dropZoneFOUT';
e.target.innerHTML = "Fout!";

mistakes = mistakes + 1;

}

updateScore();
   
  if (e.stopPropagation) {
    e.stopPropagation(); // stops the browser from redirecting.
  }


  return false;

}

function resetText(currentTarget)
{
currentTarget.className = 'dropZone';
currentTarget.innerHTML = "Sleep het woord hier heen..";
document.selection.empty();
}

function updateScore() {
scoreboard.innerHTML = "<a class=\"text\">"+mistakes+" Fout</a> | <a class=\"text\">"+succesCount+" Goed</a>";
}

/* Bug Fix: Firefox chrashed als je de geluiden te snel achterelkaar afspeelt, er zit nu een delay van 1sec op. */
function resetbSound() {
	bCanPlaySound = true;
	
}

function handleDragEnd(e) {
  // this/e.target is the source node.
 e.target.style.color = '#000000';
 e.target.style.opacity = '1';
 

}


function handleDragMouseMove(e) {
    var target = e.target;
    if (window.event.button === 1) {
        target.dragDrop();
    }
}




function SoundPlay(FileName) {
	if(bCanPlaySound){
		SoundContainer.innerHTML = "<embed src='res/"+FileName+".mp3' hidden=true autostart=true loop=false />";
	}
	
	bCanPlaySound = false;
	var timer=setTimeout(function(){resetbSound()}, 1000);
}

