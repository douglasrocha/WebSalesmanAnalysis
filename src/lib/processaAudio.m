%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
% Function: getDataFromFft
% Description:
%     Reads wav file sent by parameter and returns
% an array of 4 values respectively:
% 1) Average Frequency 
% 2) Average Amplitude
% 3) Frequency Standard Deviation
% 4) Amplitude Standard Deviation
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
function retval = getDataFromFft(filePath)
  [y, Fs, bits] = wavread(filePath);

  % Prepare time data for plot
  Nsamps = length(y);
  t = (1/Fs)*(1:Nsamps);

  %Do Fourier Transform
  %Retain Magnitude
  y_fft = abs(fft(y));

  %Discard half of points
  y_fft = y_fft(1:Nsamps / 2);

  %Prepare freq data for plot
  f = Fs * (0:Nsamps / 2 - 1) / Nsamps;
  ffilter = arrayfun(@le, f, 1200);
  y_fft = y_fft .* ffilter;

  mediaPonderada = 0;
  somaTotal = 0;
  fPonderado = 1:length(y_fft);

  for i=1:length(y_fft),
    somaTotal = somaTotal + y_fft(i);
    mediaPonderada = mediaPonderada + (y_fft(i) * f(i));
    fPonderada(i) = y_fft(i) * f(i);
  endfor

  retval = 1:4;
  retval(1) = mediaPonderada / somaTotal;
  retval(2) = sum(y_fft) / sum(ffilter);
  retval(3) = std(fPonderada);
  retval(4) = std(y_fft);
endfunction

%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
% Executes file with argv parameters
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
arg_list = argv();
filename = arg_list{1};
disp(getDataFromFft(filename));